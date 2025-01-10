@extends('layout.main')

@section('content')
<style>
    .card-hover {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-hover:hover {
        background-color: rgba(0, 0, 0, 0.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card-hover:hover .card-title,
    .card-hover:hover .card-text {
        color: #007bff;
    }

    .card-img-top {
        border-radius: 50%;
        border: 4px solid #fff;
        transition: transform 0.3s ease;
    }

    .card-img-top:hover {
        transform: scale(1.1);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 0.9rem;
        color: #555;
    }

    .text-center h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .filter-container {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h1>@lang('lang.welcome_to_connect_friend')</h1>
    </div>

    <!-- Filter Section -->
    <div class="col-md-12 mb-5 filter-container">
        <h5 class="fw-bold mb-4">@lang('lang.filter')</h5>
        <form method="GET" action="{{ route('homePage') }}">
            <div class="row">
                <!-- Gender Filter -->
                <div class="col-md-4 mb-3">
                    <label for="genderFilter" class="form-label">@lang('lang.gender')</label>
                    <select name="gender" id="genderFilter" class="form-select">
                        <option value="">@lang('lang.all')</option>
                        <option value="Male" {{ $gender_filter == 'Male' ? 'selected' : ''}}>@lang('lang.male')</option>
                        <option value="Female" {{ $gender_filter == 'Female' ? 'selected' : ''}}>@lang('lang.female')</option>
                    </select>
                </div>

                <!-- Field of Work Filter -->
                <div class="col-md-4 mb-3">
                    <label for="fieldWorkFilter" class="form-label">@lang('lang.fields_of_work')</label>
                    <select name="fields_of_work" id="fieldWorkFilter" class="form-select">
                        <option value="">@lang('lang.fields_of_work')</option>
                        @foreach($fieldsOfWork as $field)
                            <option value="{{ $field->name }}" 
                                {{ $field->name == $fields_of_work_filter ? 'selected' : '' }}>
                                {{ $field->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">@lang('lang.apply_filter')</button>
                </div>
            </div>
        </form>
    </div>

    <!-- No Friends Found Message -->
    @if($users->isEmpty())
        <div class="col-12 text-center">
            <div class="alert alert-danger pb-4">   
                <h4 class="mt-2">@lang('lang.no_friends_available')</h4>
            </div>
        </div>
    @else
        <!-- User Gallery -->
        <div class="row g-4" id="userGallery">
            @foreach($users as $user)
                <div class="col-md-4">
                    @if(Auth::check())
                        <a href="{{ route('detailPage', ['user_id' => $user->id]) }}" class="text-decoration-none text-body">
                            <div class="card text-center card-hover">
                                <div class="d-flex justify-content-center mt-4">
                                    <img src="{{ $user->profile_picture ?: asset('assets/images/default-avatar.png') }}" class="card-img-top" alt="User Photo" style="width: 150px; height: 150px;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="card-text">
                                        @lang('lang.profession'): 
                                        @if($user->fieldsOfWork->count())
                                            {{ implode(', ', $user->fieldsOfWork->pluck('name')->toArray()) }}
                                        @else
                                            @lang('lang.no_profession')
                                        @endif
                                    </p>
                                    <p class="card-text">
                                        @lang('lang.gender'): 
                                        {{ $user->gender == 'Male' ? __('lang.male') : __('lang.female') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @else
                        <!-- If the user is not logged in, redirect to login -->
                        <a href="{{ route('loginPage') }}" class="text-decoration-none text-body">
                            <div class="card text-center card-hover">
                                <div class="d-flex justify-content-center mt-4">
                                    <img src="{{ $user->profile_picture ?: asset('assets/images/default-avatar.png') }}" class="card-img-top" alt="User Photo" style="width: 150px; height: 150px;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="card-text">
                                        @lang('lang.profession'): 
                                        @if($user->fieldsOfWork->count())
                                            {{ implode(', ', $user->fieldsOfWork->pluck('name')->toArray()) }}
                                        @else
                                            @lang('lang.no_profession')
                                        @endif
                                    </p>
                                    <p class="card-text">
                                        @lang('lang.gender'): 
                                        {{ $user->gender == 'Male' ? __('lang.male') : __('lang.female') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Pagination Links -->
    <div class="text-center mt-4">
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
