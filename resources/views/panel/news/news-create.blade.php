@extends('layouts.app')

@section('title', 'News: Create Data')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/vex.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vex-theme-os.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/simplemde.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.min.css') }}">
@endsection

@section('extra-js')
<script src="{{ asset('js/simplemde.min.js') }}"></script>
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-7">
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

    <div class="col-md-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                List Gambar
                <button id="btn-card-images-refresh" class="btn btn-sm   btn-success"><i class="fa fa-refresh"></i></button>
            </div>

            <div class="card-body">
                <form class="dropzone" id="business_unit-image" enctype="multipart/form-data">
                    @csrf
                </form>
            </div>

            <table id="data-table-post_image" class="table table-responsive-sm" style="width:100%;">
                <thead>
                    <th width="50">No</th>
                    <th>Image</th>
                    <th>File Name</th>
                    <th width="100">Created At</th>
                    <th width="50" class="text-center">Action</th>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(function(){
        var simplemde = new SimpleMDE({
            element: $("#input-content")[0],
            toolbar: getToolbarSimpleMDE(),
        });

        // do request data table
        var table = $('#data-table-post_image').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('post_image.data') !!}',
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false, width: '10px'},
                {
                    data: 'url_image',
                    name: 'url_image',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta){
                        return '<img src="'+ data +'" alt="'+ row.image +'" width="50px">';
                    }
                },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta){
                        return '<div class="btn-group btn-group-sm">' +
                            '<button type="button" class="btn btn-danger button-delete" data-value="'+data+'"><i class="fa fa-trash"></i></button>' +
                            '<button type="button" class="btn btn-primary button-copy" data-value="'+row.url_image+'"><i class="fa fa-copy"></i></button>' +
                        '</div>';
                    }
                },
            ],
            'columnDefs': [
                {
                    'targets': 4,
                    'className': 'text-center',
                }
            ]
        });

        // Configuration options go here
        var dropzone = new Dropzone("#business_unit-image", {
            url: "{{ route('post_image.store') }}",
            method: "post",
            uploadMultiple : true,
            paramName : "file",
            maxFilesize: 10, // MB
            maxFiles: 5,
            parallelUploads: 5,
            addRemoveLinks: true,
            dictMaxFilesExceeded: "You can only upload upto 5 images",
            dictRemoveFile: "Delete",
            dictCancelUploadConfirmation: "Are you sure to cancel upload?",
            success:function(file, response){
                // refresh table
                table.draw();

                // Do what you want to do with your response
                // This return statement is necessary to remove progress bar after uploading.
                return file.previewElement.classList.add("dz-success");
            },
            accept: function (file, done) {
                if ((file.type).toLowerCase() != "image/jpg" &&
                        (file.type).toLowerCase() != "image/gif" &&
                        (file.type).toLowerCase() != "image/jpeg" &&
                        (file.type).toLowerCase() != "image/png"
                        ) {
                    done("Invalid file");
                }
                else {
                    done();
                }
            },
            removedfile: function(file){
                //showLoading();

                axios.delete("{{ url('panel/post_image') }}/" + file.id + "/delete")
                    .then(function (response) {

                    })
                    .catch(function (error) {

                    });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });

        ////////////
        // Events //
        ////////////

        $('#btn-card-images-refresh').click(function(){
            // refresh table
            table.draw();
        });

        $('#data-table-post_image tbody').on('click', '.button-copy', function(){
            var value = $(this).data('value');

            copyTextToClipboard(value);
        });

        $('#data-table-post_image tbody').on('click', '.button-delete', function(){
            var value = $(this).data('value');

            vex.dialog.confirm({
                message: 'Anda yakin untuk menghapus gambar ini?',
                callback: function (responseDialog) {
                    if (responseDialog) {
                        // do request endpoint...
                        showLoading();
                        axios.delete("{{ url('panel/post_image') }}/" + value + "/delete")
                          .then(function (response) {
                            // handle success
                            hideLoading();

                            // do refresh table
                            table.draw();
                          })
                          .catch(function (error) {
                            // handle error
                            hideLoading();
                          });
                    }
                }
            });
        });

        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;

            // Avoid scrolling to bottom
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');

                if(successful){
                    window.alert('Success! The text was copied to your clipboard')
                }else{
                    window.alert('Fallback: Oops, unable to copy', err)
                }
            } catch (err) {
                window.alert('Fallback: Oops, unable to copy', err)
            }

            document.body.removeChild(textArea);
        }

        function copyTextToClipboard(text) {
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(function() {
                /* clipboard successfully set */
                window.alert('Success! The text was copied to your clipboard')
            }, function(err) {
                /* clipboard write failed */
                window.alert('Opps! Your browser does not support the Clipboard')
            });
        }
    });
</script>
@endpush
