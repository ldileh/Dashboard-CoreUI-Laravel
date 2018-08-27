@extends('layouts.app-login')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
              <form method="post" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf

                <h1>{{ __('Login') }}</h1>
                <p class="text-muted">Sign In to your account</p>

                {{-- input email --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-user"></i>
                        </span>
                    </div>
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- input password --}}
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-lock"></i>
                        </span>
                    </div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('Password') }}">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- remember me form --}}
                <div class="row" style="margin-bottom: 16px;">
                    <div class="col-6">
                        <div style="margin-left: 20px;">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                          <label class="form-check-label" for="remember">
                              {{ __('Remember Me') }}
                          </label>
                        </div>
                    </div>
                </div>

                {{-- button form --}}
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                  </div>
                  <div class="col-6 text-right">
                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
