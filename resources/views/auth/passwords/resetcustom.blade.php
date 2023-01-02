@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translate.change_password') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('home.resetpassword.post') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('translate.new_password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control x @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('translate.password_confirmation') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control x @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-check col-12 text-center">
                              <input class="form-check-input" type="checkbox" id="gridCheck" checked onclick="myFunction()">
                              <label class="form-check-label" for="gridCheck">
                                {{ __('translate.show_password') }}
                              </label>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('translate.save') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var x = document.getElementsByClassName("x");
        for (let i = 0; i < x.length; i++) {
            if (x[i].type === "password") {
              x[i].type = "text";
            } else {
              x[i].type = "password";
            }
        }
        // x.forEach(element => {
        //     if (element.type === "password") {
        //       element.type = "text";
        //     } else {
        //       element.type = "password";
        //     }
        // });
    }
</script>
@endsection
