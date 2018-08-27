@extends('layouts.app-login')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                @csrf

                <h1>{{ __('Reset Password') }}</h1>
                <p class="text-muted">Reset your password account</p>

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

                {{-- button form --}}
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Send Password Reset Link') }}</button>
                  </div>

                  <div class="col-6 text-right">
                    <a class="btn btn-default px-4" href="{{ route('login') }}">{{ __('Back') }}</a>
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
