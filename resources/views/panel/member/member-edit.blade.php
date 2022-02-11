@extends('layouts.app')

@section('title', 'Member: Edit Data')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.css') }}">
@endsection

@section('extra-js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><i class="fa fa-th-list"></i> Form Member Data</div>

            <form class="form-horizontal" action="{{ route('member.data.edit', $data->id) }}" method="post" aria-label="{{ __('Member') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    @include('layouts.info-layout')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-name">{{ __('Nama') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="input-name" maxlength="225" value="{{ old('name') ? old('name') : $data->name }}">

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-birth_place">{{ __('Tempat Lahir') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="birth_place" class="form-control" id="input-birth_place" maxlength="191" value="{{ old('birth_place') ? old('birth_place') : $data->birth_place }}">

                            @if ($errors->has('birth_place'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birth_place') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-birth_date">{{ __('Tanggal Lahir') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="birth_date" class="form-control date-picker" id="input-birth_date" value="{{ old('birth_date') ? old('birth_date') : $data->birth_date }}">

                            @if ($errors->has('birth_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birth_date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-gender">{{ __('Jenis Kelamin') }}</label>
                        <div class="col-md-9">
                            <select name="gender" id="input-gender" class="form-control select2 form-select2">
                                @php
                                    $tempGender = old('gender') ? old('gender') : $data->gender;
                                @endphp
                                @foreach ($gender as $key => $value)
                                <option value="{{ $key }}"@if ($key == $tempGender)
                                 selected='selected'
                                @endif >{{ $value }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-nik">{{ __('NIK') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="nik" class="form-control" id="input-nik" value="{{ old('nik') ? old('nik') : $data->nik }}">

                            @if ($errors->has('nik'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nik') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-profession">{{ __('Profesi') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="profession" class="form-control" id="input-profession" value="{{ old('profession') ? old('profession') : $data->profession }}">

                            @if ($errors->has('profession'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('profession') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-address">{{ __('Address') }}</label>
                        <div class="col-md-9">
                            <textarea name="address" id="input-address" class="form-control">{{ old('address') ? old('address') : $data->address }}</textarea>

                            @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-phone_number">{{ __('Nomor Telepon') }}</label>
                        <div class="col-md-9">
                            <input type="tel" name="phone_number" class="form-control" id="input-phone_number" value="{{ old('phone_number') ? old('phone_number') : $data->phone_number }}">

                            @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-email">{{ __('E-mail') }}</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" id="input-email" value="{{ old('email') ? old('email') : $data->email }}">

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-file_ktp">{{ __('File KTP') }}</label>
                        <div class="col-md-9">
                            <input type="file" name="file_ktp" class="form-control" id="input-file_ktp"/>

                            @if ($errors->has('file_ktp'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file_ktp') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-file_pass_photo">{{ __('File Pass Photo') }}</label>
                        <div class="col-md-9">
                            <input type="file" name="file_pass_photo" class="form-control" id="input-file_pass_photo"/>

                            @if ($errors->has('file_pass_photo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file_pass_photo') }}</strong>
                            </span>
                            @endif
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
