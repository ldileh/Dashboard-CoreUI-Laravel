@extends('layouts.app')

@section('title', 'Product: Edit Data')

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
            <div class="card-header"><i class="fa fa-th-list"></i> Form Product Data</div>

            <form class="form-horizontal" action="{{ route('product.data.edit', $data->id) }}" method="POST" aria-label="{{ __('Product') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    @include('layouts.info-layout')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="input-image">{{ __('Banner') }}</label>
                        <div class="col-md-9">
                            <input type="file" name="image" class="form-control" id="input-image" value="{{ old('image') ? old('image') : $data->image }}">

                            @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

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

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-description">{{ __('Description') }}</label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="input-description">{{ old('description') ? old('description') : $data->description }}</textarea>

                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
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
