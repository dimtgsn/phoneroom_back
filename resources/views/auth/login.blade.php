@extends('layouts.app')

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <a href="{{ env('APP_URL', '/') }}">
                            <img class="" src="{{ asset("dist/img/Group 771.svg") }}">
                        </a>
                    </div>

                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Login</h4>

                            <form method="POST" action="{{ route('login') }}" class="my-login-validation">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="email" class="">{{ __('Email Address') }}</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password" class="">{{ __('Password') }}
                                        @if (Route::has('password.request'))
                                            <a class="float-end" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </label>

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn w-100 btn-danger btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
