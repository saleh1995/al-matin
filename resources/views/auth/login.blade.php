@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('translate.login') }}</div>

                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('img/almatin_group.png') }}" alt="" class="img-fluid mb-5">
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="job_id" class="col-md-4 col-form-label text-md-right">{{ __('translate.job_id') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="job_id" id="" class="form-control @error('job_id') is-invalid @enderror" value="{{ old('job_id') }}" required autofocus autocomplete="on">
                                @error('job_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('translate.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('translate.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('translate.login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-muted">
                    <div class="text-center pt-3">
                        {{ __('translate.credits') }}
                    </div>
                    <div class="text-center p-3">
                        2023 © 
                        <a href="https://almatin.com/">Almatin.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
