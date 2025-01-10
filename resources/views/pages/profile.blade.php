@extends('layout.main')

@section('content')
    <div class="container mt-4">
        <!-- Profile Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">{{ Auth::user()->name }}'s Profile</h1>
            <p class="text-muted">{{ Auth::user()->email }}</p>
            <div class="d-inline-block position-relative">
                <img src="{{ Auth::user()->profile_picture ?: asset('assets/images/default-avatar.png') }}" alt="Profile Picture" class="rounded-circle border border-3 border-primary" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
        </div>

        <div class="row g-4">
            <!-- Profile Details Section -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">@lang('lang.profile_detail')</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>@lang('lang.gender'): </strong>{{ Auth::user()->gender }}</li>
                            <li class="list-group-item">
                                <strong>@lang('lang.fields_of_work'): </strong>
                                @if(Auth::user()->fieldsOfWork->count())
                                    {{ implode(', ', Auth::user()->fieldsOfWork->pluck('name')->toArray()) }}
                                @else
                                    @lang('lang.no_profession')
                                @endif
                            </li>
                            <li class="list-group-item"><strong>LinkedIn: </strong><a href="https://www.linkedin.com/in/{{ Auth::user()->linkedin_username }}" target="_blank" rel="noopener noreferrer">{{ Auth::user()->linkedin_username }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Profile Visibility Section -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">@lang('lang.profile_visibility')</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('changeVisibility') }}" id="visibilityForm">
                            @csrf
                            <label for="visibility" class="form-label">
                                @lang('lang.toggle_visibility'): 
                                <span class="badge {{ Auth::user()->visibility == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ Auth::user()->visibility == 1 ? __('lang.profile_on') : __('lang.profile_off') }}
                                </span>
                            </label>
                            <select class="form-select mb-3" id="visibility" name="visibility">
                                <option value="1" {{ Auth::user()->visibility ? 'selected' : '' }}>@lang('lang.show_profile')</option>
                                <option value="0" {{ !Auth::user()->visibility ? 'selected' : '' }}>@lang('lang.hide_profile')</option>
                            </select>
                            <button type="submit" class="btn btn-primary w-100">@lang('lang.update_visibility')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Avatar Section -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">@lang('lang.your_avatar')</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <form method="POST" action="{{ route('changeAvatar') }}">
                            @csrf
                            <input type="hidden" name="avatar_path" value="">
                            <div class="card text-center pt-3 {{ Auth::user()->profile_picture === null ? 'border border-3 border-success shadow' : '' }}" style="cursor: pointer;" onclick="this.closest('form').submit();">
                                <img src="{{ asset('assets/images/default-avatar.png') }}" alt="Avatar" class="card-img-top" style="height: 100px; object-fit: contain;">
                                <div class="card-body">
                                    <p class="card-text">Default</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    @forelse($avatars as $avatar)
                        <div class="col-md-3">
                            <form method="POST" action="{{ route('changeAvatar') }}">
                                @csrf
                                <input type="hidden" name="avatar_path" value="{{ $avatar->path }}">
                                <div class="card text-center pt-3 {{ Auth::user()->profile_picture === $avatar->path ? 'border border-3 border-success shadow' : '' }}" style="cursor: pointer;" onclick="this.closest('form').submit();">
                                    <img src="{{ $avatar->path }}" alt="Avatar" class="card-img-top" style="height: 100px; object-fit: contain;">
                                    <div class="card-body">
                                        <p class="card-text">{{ $avatar->name }}</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @empty
                        <p class="text-muted">@lang('lang.dont_have_avatar')</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Button to Buy New Avatar -->
        <div class="text-center mt-4">
            <a href="{{ route('avatarMarketPage') }}" class="btn btn-outline-primary">@lang('lang.buy_new_avatar')</a>
        </div>
    </div>
@endsection
