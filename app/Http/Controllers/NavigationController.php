<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\AvatarTransaction;
use App\Models\Chat;
use App\Models\Friend;
use App\Models\User;
use App\Models\FieldOfWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{  
    
    public function homePage(Request $request)
    {
        // Menyaring berdasarkan gender dan bidang pekerjaan (field of work)
        $users = User::query();
        
        // Menyaring berdasarkan visibilitas profil (hanya yang visible)
        $users->where('visibility', 1);  // Tambahkan kondisi untuk menampilkan hanya pengguna dengan visibility = 1
        
        // Menyimpan nilai filter yang diterima
        $gender_filter = $request->gender;
        $fields_of_work_filter = $request->fields_of_work;

        // Menambahkan filter berdasarkan gender jika ada
        if ($request->has('gender') && $request->gender != '') {
            $users->where('gender', $request->gender);
        }

        // Menambahkan filter berdasarkan bidang pekerjaan (fields_of_work) jika ada
        if ($request->has('fields_of_work') && $request->fields_of_work != '') {
            $users->whereHas('fieldsOfWork', function($query) use ($request) {
                $query->where('name', $request->fields_of_work);
            });
        }

        // Mengambil hasil pengguna yang sudah difilter, dengan pagination (6 per halaman)
        $users = $users->with('fieldsOfWork')->paginate(6);

        // Mengambil semua bidang pekerjaan untuk dropdown filter
        $fieldsOfWork = FieldOfWork::all();

        // Mengirimkan data ke tampilan
        return view('pages.index', compact('users', 'fieldsOfWork', 'gender_filter', 'fields_of_work_filter'));
    }

    public function friendPage(Request $request)
    {
        // Ambil semua field_of_work untuk dropdown
        $fieldsOfWork = FieldOfWork::all(); // Ambil semua bidang pekerjaan

        if (!Auth::check()) {
            $users = User::when($request->gender, function ($query) use ($request) {
                    return $query->where('gender', $request->gender);
                })
                ->when($request->fields_of_work, function ($query) use ($request) {
                    return $query->whereHas('fieldsOfWork', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->fields_of_work . '%');
                    });
                })
                ->when($request->name, function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->name . '%');
                })
                ->where('visibility', true)
                ->paginate(6); // Menambahkan pagination
        } else {
            $authUserId = Auth::user()->id;
            $excludedUserIds = Friend::where('sender_id', $authUserId)
                ->orWhere('receiver_id', $authUserId)
                ->get(['sender_id', 'receiver_id'])
                ->flatMap(function ($friend) {
                    return [$friend->sender_id, $friend->receiver_id];
                })
                ->push($authUserId)
                ->unique()
                ->toArray();

            $users = User::whereNotIn('id', $excludedUserIds)
                ->when($request->gender, function ($query) use ($request) {
                    return $query->where('gender', $request->gender);
                })
                ->when($request->fields_of_work, function ($query) use ($request) {
                    return $query->whereHas('fieldsOfWork', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->fields_of_work . '%');
                    });
                })
                ->when($request->name, function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->name . '%');
                })
                ->where('visibility', true)
                ->paginate(4); // Menambahkan pagination
        }

        // Proses fields_of_work untuk setiap user dengan relasi
        foreach ($users as $user) {
            // Ambil relasi fieldsOfWork untuk user
            $fieldsOfWorkArray = $user->fieldsOfWork->pluck('name')->toArray();
            // Menyimpan hasilnya kembali ke user
            $user->fields_of_work = $fieldsOfWorkArray;
        }

        return view('pages.friend')
            ->with('users', $users) // Mengirim data pengguna dengan pagination
            ->with('fieldsOfWork', $fieldsOfWork) // Kirim data field_of_works untuk dropdown
            ->with('fields_of_work_filter', $request->fields_of_work)
            ->with('gender_filter', $request->gender);
    }



    public function detailPage($user_id)
    {
        $user = User::findOrFail($user_id);

        // Ambil relasi fieldsOfWork untuk user
        $fieldsOfWork = $user->fieldsOfWork->pluck('name')->toArray();

        // Kirim data user dan fields_of_work ke tampilan
        return view('pages.detail', compact('user', 'fieldsOfWork'));
    }


    public function registerPage()
    {
        if (session()->has('payment_expires')) {
            if (now()->greaterThan(session('payment_expires'))) {
                session()->flush();
            }
        }

        // Mengambil semua data bidang pekerjaan
        $fieldsOfWork = FieldOfWork::all();

        // Mengirimkan data fieldsOfWork ke view
        return view('authenthication.register', compact('fieldsOfWork'));
    }

    public function loginPage()
    {
        return view('authenthication.login');
    }

    public function topupPage()
    {
        return view('pages.top-up');
    }

    public function myProfilePage()
    {
        $ownedAvatarIds = AvatarTransaction::where('buyer_id', Auth::user()->id)->pluck('avatar_id');

        $avatars = Avatar::whereIn('id', $ownedAvatarIds)->get();

        return view('pages.profile', compact('avatars'));
    }

    public function avatarMarketPage()
    {
        $ownedAvatarIds = AvatarTransaction::where('buyer_id', Auth::user()->id)->pluck('avatar_id');

        $avatars = Avatar::whereNotIn('id', $ownedAvatarIds)->paginate(9);

        return view('pages.avatar-market', compact('avatars'));
    }

    public function friendRequestPage()
    {
        $authUserId = Auth::user()->id;

        $includedUserIdsPending = Friend::where('receiver_id', $authUserId)
            ->where('status', 'Pending')
            ->pluck('sender_id');

        Friend::whereIn('sender_id', $includedUserIdsPending)
            ->where('receiver_id', $authUserId)
            ->update([
                'seen' => true
            ]);

        // Ambil permintaan teman yang tertunda dan relasi bidang pekerjaan
        $pendingRequests = User::whereIn('id', $includedUserIdsPending)
            ->with('fieldsOfWork') // Menambahkan relasi untuk fields_of_work
            ->get();

        // Ambil teman yang diterima
        $includedUserIdsAccepted = Friend::where(function ($query) use ($authUserId) {
                $query->where('sender_id', $authUserId)
                    ->orWhere('receiver_id', $authUserId);
            })
            ->where('status', 'Accepted')
            ->get(['sender_id', 'receiver_id'])
            ->flatMap(function ($friend) {
                return [$friend->sender_id, $friend->receiver_id];
            })
            ->unique()
            ->reject(fn($id) => $id == Auth::user()->id)
            ->toArray();

        $acceptedFriends = User::whereIn('id', $includedUserIdsAccepted)->get();

        return view('pages.friend-request', compact('pendingRequests', 'acceptedFriends'));
    }


    public function chatPage($current_chat_id = null)
    {
        $chats = Chat::where('sender_id', Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id)
            ->get();

        $userIds = $chats->pluck('sender_id')
            ->merge($chats->pluck('receiver_id'))
            ->unique()
            ->reject(fn($id) => $id == Auth::user()->id);

        $users = User::whereIn('id', $userIds)
            ->get();

        if (!$current_chat_id){
            $chats = null;
        } else{
            $chats = Chat::whereIn('sender_id', [$current_chat_id, Auth::user()->id])
                ->whereIn('receiver_id', [$current_chat_id, Auth::user()->id])
                ->get();

            if ($chats->isEmpty()){
                $currentUserChat = User::findOrFail($current_chat_id);
                $users->push($currentUserChat);
            } else{
                if ($chats[0]->receiver_id == Auth::user()->id){
                    foreach ($chats as $chat) {
                        $chat->seen = true;
                        $chat->save();
                    }
                }
            }
        }

        return view('pages.chat', compact('chats', 'users', 'current_chat_id'));
    }

    public function notificationPage()
    {
        $authUserId = Auth::user()->id;

        $chatNotification = Chat::where('receiver_id', $authUserId)
            ->where('seen', false)
            ->orderBy('created_at', 'desc')
            ->get();

        $includedUserIdsPending = Friend::where('receiver_id', $authUserId)
            ->where('status', 'Pending')
            ->where('seen', false)
            ->pluck('sender_id');

        $friendRequestNotification = User::
            whereIn('id', $includedUserIdsPending)
            ->get();

        return view('pages.notification', compact('chatNotification', 'friendRequestNotification'));
    }
}