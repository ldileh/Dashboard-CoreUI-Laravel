@extends('layouts.app')

@section('title', 'News: Create Data')

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
            <div class="card-header"><i class="fa fa-th-list"></i> Form News Data</div>

            <form class="form-horizontal" action="{{ route('news.data.create') }}" method="post" aria-label="{{ __('News') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('layouts.info-layout')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-name">{{ __('Banner') }}</label>
                        <div class="col-md-9">
                            <input type="file" name="banner" class="form-control" id="input-banner" value="{{ old('banner') }}">

                            @if ($errors->has('banner'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('banner') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-name">{{ __('Title') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" id="input-title" maxlength="191" value="{{ old('title') }}">

                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-email">{{ __('Descrpition') }}</label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="input-description">{{ old('description') }}</textarea>

                            @if ($errors->has('descrpition'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('descrpition') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-content">{{ __('Content') }}</label>
                        <div class="col-md-9">
                            <textarea name="content" class="form-control" id="input-content">{{ old('content') }}</textarea>

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
