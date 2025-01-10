@extends('layout.main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <h3 class="mb-4">@lang('lang.friend_request')</h3>
                <!-- Tab Navigation -->
                <ul class="nav nav-pills mb-3" id="friendTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pending-tab" data-bs-toggle="pill" href="#pending" role="tab" aria-controls="pending" aria-selected="true">@lang('lang.pending_request')</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="accepted-tab" data-bs-toggle="pill" href="#accepted" role="tab" aria-controls="accepted" aria-selected="false">@lang('lang.accepted_friend')</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="friendTabContent">
                    <!-- Pending Requests -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="row">
                            @foreach($pendingRequests as $user)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm border-light">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="{{ asset('assets/images/default-avatar.png') }}" class="rounded-circle me-3" alt="User Avatar" style="height: 80px; width: 80px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <a href="{{ route('detailPage', ['user_id'=>$user->id]) }}" class="h5">{{ $user->name }}</a>
                                                <p class="card-text mb-2 text-muted">
                                                    @if(!empty($user->fieldsOfWork)) 
                                                        {{ implode(', ', $user->fieldsOfWork->pluck('name')->toArray()) }}
                                                    @else
                                                        @lang('lang.no_profession')
                                                    @endif
                                                </p>
                                                <div class="d-flex justify-content-start gap-2">
                                                    <form method="POST" action="{{ route('acceptFriend', ['sender_id'=>$user->id]) }}" class="w-50">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm w-100">Accept</button>
                                                    </form>
                                                    <form method="POST" action="{{ route('rejectFriend', ['sender_id'=>$user->id]) }}" class="w-50">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm w-100">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            @endforeach
                        </div>
                    </div>

                    <!-- Accepted Friends -->
                    <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
                        <div class="row">
                            @foreach($acceptedFriends as $friend)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm border-light">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="{{ $friend->profile_picture ?: asset('assets/images/default-avatar.png') }}" class="rounded-circle me-3" alt="User Avatar" style="height: 60px; width: 60px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-1">{{ $friend->name }}</h5>
                                                <p class="card-text mb-2 text-muted">
                                                    @if(!empty($friend->fieldsOfWork)) 
                                                        {{ implode(', ', $friend->fieldsOfWork->pluck('name')->toArray()) }}
                                                    @else
                                                        @lang('lang.no_profession')
                                                    @endif
                                                </p>
                                                <a href="{{ route('chatPage', ['current_chat_id' => $friend->id]) }}" class="btn btn-success btn-sm">
                                                    <i class="bi bi-chat-dots"></i> @lang('lang.chat')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
