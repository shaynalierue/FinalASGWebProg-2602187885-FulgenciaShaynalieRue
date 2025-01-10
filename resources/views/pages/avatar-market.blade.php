@extends('layout.main')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">@lang('lang.avatar_shop')</h1>
    </div>
    <div class="row g-4">
        @foreach($avatars as $avatar)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="position-relative">
                    <img src="{{ asset($avatar->path) }}" class="card-img-top" alt="{{ $avatar->name }}" style="height: 200px; object-fit: contain; background: #f8f9fa; border-bottom: 1px solid #ddd;">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold text-dark">{{ $avatar->name }}</h5>
                    <p class="card-text text-muted">{{ $avatar->description }}</p>
                    <p class="text-primary fw-bold">{{ $avatar->price }} Coins</p>
                    @if (Auth::user()->coin >= $avatar->price)
                        <form method="POST" action="{{ route('purchaseAvatar', ['avatar_id'=>$avatar->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm w-100">@lang('lang.buy_now')</button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-sm w-100" disabled>@lang('lang.insufficient_coins')</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $avatars->links() }}
    </div>
</div>
@endsection