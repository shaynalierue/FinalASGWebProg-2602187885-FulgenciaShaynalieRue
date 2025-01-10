<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 500px;">
            <h2 class="text-center mb-4">@lang('lang.register')</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">@lang('lang.full_name')</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="@lang('lang.full_name_placeholder')" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="@lang('lang.email_placeholder')" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="@lang('lang.password_placeholder')">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">@lang('lang.gender')</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="" disabled selected>@lang('lang.gender_placeholder')</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : ''}}>@lang('lang.male')</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : ''}}>@lang('lang.female')</option>
                    </select>
                    @error('gender')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fields_of_work" class="form-label">@lang('lang.fields_of_work')</label>
                    @foreach($fieldsOfWork as $field)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $field->id }}" id="field_{{ $field->id }}" name="fields_of_work[]"
                                {{ in_array($field->id, old('fields_of_work', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="field_{{ $field->id }}">
                                {{ $field->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('fields_of_work')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="linkedin_username" class="form-label">@lang('lang.linkedin_username')</label>
                    <input type="text" class="form-control" id="linkedin_username" name="linkedin_username" placeholder="https://www.linkedin.com/in/yourusername" value="{{ old('linkedin_username') }}">
                    @error('linkedin_username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">@lang('lang.phone_number')</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="@lang('lang.phone_number_placeholder')" value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success w-100">@lang('lang.register')</button>
                <div class="text-center mt-3">
                    <p>@lang('lang.already_have_account') <a href="{{ route('loginPage') }}" class="text-decoration-none">@lang('lang.login')</a></p>
                </div>
            </form>
            <div class="text-center mt-3">
                <p class="mb-0">
                    @lang('lang.back_to')
                    <a href="{{ route('homePage') }}" class="text-decoration-none">@lang('lang.home')</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Payment Modal Start -->
    <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="paymentModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('payment') }}" class="modal-content shadow">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="paymentModal">
                        <i class="bi bi-cash-stack me-2"></i> Payment Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info d-flex align-items-center">
                        <i class="bi bi-info-circle me-2"></i>
                        <p class="mb-0">Registration Fee: <strong>Rp {{ session('registration_fee') }}</strong></p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="amount" class="form-label">Enter Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter the fee amount" value="{{ old('amount') }}">
                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Close
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Confirm Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Payment Modal End -->

    <!-- Overpaid Modal Start -->
    <div class="modal fade" id="overpaid" tabindex="-1" aria-labelledby="overpaidModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('overpaidPayment') }}" class="modal-content shadow">
                @csrf
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="overpaidModal">
                        <i class="bi bi-exclamation-triangle me-2"></i> Overpaid
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">
                        You have overpaid <strong>Rp {{ session('overpaid') }}</strong>. Would you like to allocate the balance?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> No
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Yes
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Overpaid Modal End -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentModal = new bootstrap.Modal(document.getElementById('payment'));
            const overpaidModal = new bootstrap.Modal(document.getElementById('overpaid'));

            @if (session('overpaid'))
                // Prioritaskan overpaid jika kedua kondisi aktif
                overpaidModal.show();
            @elseif (session('payment'))
                paymentModal.show();
            @endif
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>