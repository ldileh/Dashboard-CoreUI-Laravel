@extends('layouts.app')

@section('title', 'Users: Create Data')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><i class="fa fa-th-list"></i> Form User Data</div>

            <form class="form-horizontal" action="{{ route('user.data.edit', $data->id) }}" method="post" aria-label="{{ __('Edit User') }}">
                @csrf
                <div class="card-body">
                    @include('layouts.info-layout')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-name">{{ __('Name') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="input-name" maxlength="191" value="{{ old('name') ? old('name') : $data->name }}">
                            
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-email">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" id="input-email" maxlength="191" value="{{ old('email') ? old('email') : $data->email }}">
                            
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-password">{{ __('Password') }}</label>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" id="input-password" maxlength="191">
                            
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-password">{{ __('Confirm Password') }}</label>
                        <div class="col-md-9">
                            <input type="password" name="password_confirmation" class="form-control" id="input-password" maxlength="191">
                        </div>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush