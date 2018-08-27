@extends('layouts.app-login')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <form method="post" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf

                <h1>{{ __('Register') }}</h1>
                <p class="text-muted">Sign Up your account</p>

                {{-- input name --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-user"></i>
                        </span>
                    </div>
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- input email --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-envelope-open"></i>
                        </span>
                    </div>
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- input password --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-lock"></i>
                        </span>
                    </div>
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="{{ __('Password') }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- input password --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-lock"></i>
                        </span>
                    </div>
                    <input class="form-control" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                </div>

                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Register') }}</button>
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
