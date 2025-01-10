@extends('layout.main')

@section('content')
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h1>{{ $user->name }}'s Profile</h1>
            <p class="text-muted">{{ $user->email }}</p>
            <img src="{{ $user->profile_picture ?: asset('assets/images/default-avatar.png') }}" alt="Profile Picture" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        </div>

        <div class="card p-4 shadow-sm">
            <h5>@lang('lang.profile_detail')</h5>
            <ul class="list-unstyled">
                <li><strong>@lang('lang.gender'):</strong> {{ $user->gender == 'Male' ? 'Male' : 'Female' }}</li>
                <li><strong>@lang('lang.profession'):</strong> 
                    @if(!empty($fieldsOfWork)) 
                        {{ implode(', ', $fieldsOfWork) }}
                    @else
                        @lang('lang.no_profession')
                    @endif
                </li>
                <li><strong>LinkedIn:</strong> 
                    @if($user->linkedin_username)
                        <a href="{{ $user->linkedin_username }}" target="_blank" rel="noopener noreferrer">{{ $user->linkedin_username }}</a>
                    @else
                        @lang('lang.no_linkedin')
                    @endif
                </li>
            </ul>
        </div>
    </div>
@endsection
