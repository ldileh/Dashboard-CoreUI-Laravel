@extends('layouts.app')

@section('title', 'Business Unit: Edit Data')

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
            <div class="card-header"><i class="fa fa-th-list"></i> Form Business Unit Data</div>

            <form class="form-horizontal" action="{{ route('business_unit.data.edit', $data->id) }}" method="post" aria-label="{{ __('Business Unit') }}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    @include('layouts.info-layout')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-name">{{ __('Title') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" id="input-title" maxlength="191" value="{{ old('title') ? old('title') : $data->title }}">

                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    @if (!$parents->isEmpty())
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-business_unit">{{ __('Parent Unit Usaha') }}</label>
                        <div class="col-md-9">
                            <select name="business_unit" id="input-business_unit" class="form-control form-select2">
                                <option></option>
                                @php
                                    $tempBusinessUnit = old('business_unit') ? old('business_unit') : $data->business_unit_id;
                                @endphp
                                @foreach ($parents as $item)
                                <option value="{{ $item->id }}"@if ($item->id == $tempBusinessUnit)
                                 selected='selected'
                                @endif >{{ $item->title }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('business_unit'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('business_unit') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-url_page">{{ __('Page Url') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="url_page" class="form-control" id="input-url_page" maxlength="225" value="{{ old('url_page') ? old('url_page') : $data->url_page }}">

                            @if ($errors->has('url_page'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url_page') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-content">{{ __('Content') }}</label>
                        <div class="col-md-9">
                            <textarea name="content" class="form-control" id="input-content">{{ old('content') ? old('content') : $data->content }}</textarea>

                            @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
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
<script type="text/javascript">
    var simplemde = new SimpleMDE({
        element: $("#input-content")[0],
        toolbar: ["bold", "italic", "strikethrough", "heading", "heading-smaller", "heading-bigger", "heading-1", "heading-2", "heading-3", "quote", "ordered-list", "unordered-list", "link", "preview"]
    });
</script>
@endpush
