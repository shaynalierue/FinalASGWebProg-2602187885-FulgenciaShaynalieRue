@extends('layout.main')

@section('content')

<!-- Judul Chat -->
<h1 class="text-center">@lang('lang.chat')</h1> <!-- Menampilkan judul 'Chat' yang terpusat -->

<div class="container mt-5">
    <div class="row">
        <!-- Kolom untuk daftar pengguna yang terlibat dalam chat -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('lang.user_chat')</strong> <!-- Menampilkan header untuk daftar pengguna -->
                </div>
                <div class="list-group list-group-flush">
                    <!-- Daftar pengguna -->
                    @foreach ($users as $user)
                        <a href="{{ route('chatPage', ['current_chat_id' => $user->id]) }}" 
                           class="list-group-item list-group-item-action d-flex align-items-center {{ $current_chat_id == $user->id ? 'bg-success text-white' : '' }}">
                            <!-- Menampilkan foto profil pengguna -->
                            <img src="{{ $user->profile_picture ?: asset('assets/images/default-avatar.png') }}" 
                                 alt="{{ $user->name }}'s avatar" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                            <span>{{ $user->name }}</span> <!-- Nama pengguna -->
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Kolom untuk menampilkan chat dan form input pesan -->
        @if ($chats)
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="height: 500px; overflow-y: scroll;" id="chat-window">
                        <!-- Menampilkan pesan chat -->
                        @foreach ($chats as $chat)
                            <div class="d-flex {{ $chat->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                                <div class="p-3 rounded {{ $chat->sender_id === auth()->id() ? 'bg-danger text-white' : 'bg-light text-dark' }}" style="max-width: 70%;">
                                    <p class="m-0">{{ $chat->message }}</p> <!-- Pesan chat -->
                                    <small class="text-dark">{{ $chat->created_at->format('d M Y H:i') }}</small> <!-- Waktu pesan -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Form untuk mengirimkan pesan -->
                <form method="POST" action="{{ route('sendMessage', ['receiver_id'=>$current_chat_id]) }}" id="chat-form" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="message" id="message" class="form-control" placeholder="Type your message">
                        <button type="submit" class="btn btn-primary">Send</button> <!-- Tombol Kirim -->
                    </div>
                    <!-- Menampilkan error jika ada -->
                    @error('message')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        @endif
    </div>
</div>

@endsection
