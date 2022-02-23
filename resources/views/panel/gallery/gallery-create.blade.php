@extends('layouts.app')

@section('title', 'Gallery: Create Data')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simplemde.min.css') }}">
@endsection

@section('extra-js')
<script src="{{ asset('js/simplemde.min.js') }}"></script>x`
@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><i class="fa fa-th-list"></i> Form Gallery Data</div>

            <form class="form-horizontal" action="{{ route('gallery.data.create.new') }}" method="post" aria-label="{{ __('Gallery') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('layouts.info-layout')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-name">{{ __('Gallery Name') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="input-banner" value="{{ old('name') }}" maxlength="225">

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
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
