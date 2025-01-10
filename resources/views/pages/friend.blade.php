@extends('layout.main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Filter Section -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">@lang('lang.filter')</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('friendPage') }}">
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
                </div>
            </div>

            <!-- Friends List Section -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">@lang('lang.friend')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @forelse ($users as $user)
                                <div class="col-md-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="{{ $user->profile_picture ?: asset('assets/images/default-avatar.png') }}" class="rounded-circle me-3 border border-secondary" alt="User Avatar" style="height: 60px; width: 60px; object-fit: cover;">
                                            <div>
                                                <h5 class="card-title mb-1">
                                                    <a href="{{ route('detailPage', ['user_id'=>$user->id]) }}" class="text-decoration-none text-dark">
                                                        {{ $user->name }}
                                                    </a>
                                                </h5>
                                                <p class="card-text text-muted mb-1">
                                                    @lang('lang.gender'): 
                                                    {{ $user->gender == 'Male' ? __('lang.male') : __('lang.female') }}
                                                </p>
                                                <p class="card-text text-muted">
                                                    @lang('lang.profession'): 
                                                    @if(!empty($user->fields_of_work))
                                                        {{ implode(', ', $user->fields_of_work) }}
                                                    @else
                                                        @lang('lang.no_profession')
                                                    @endif
                                                </p>
                                                <form method="POST" action="{{ route('addFriend', ['receiver_id'=>$user->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">👍 @lang('lang.add_friend')</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <div class="alert alert-danger">
                                        <h4 class="mt-2">@lang('lang.no_friends_available')</h4>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
