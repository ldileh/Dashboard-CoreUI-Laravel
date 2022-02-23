@extends('layouts.app')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.min.css') }}">
@endsection

@section('extra-js')
<script src="{{ asset('js/dropzone.min.js') }}"></script>
@endsection

@section('title', 'Gallery')

@section('content')
@include('layouts.info-layout')

{{-- table list --}}
<div class="row">
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    <i class="icon icon-menu"></i> Data Gallery : {{ $data->name }}
                </div>
            </div>

            <div class="card-body">
                <form class="dropzone" id="galleries-image" enctype="multipart/form-data">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    /////////////////////
    // Others function //
    /////////////////////

    ///////////////////
    // Main Function //
    ///////////////////
    $(function(){
        // Configuration options go here
        var dropzone = new Dropzone("#galleries-image", {
            url: "{{ route('gallery.data.create', $gallery_id) }}",
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

                axios.delete("{{ url('panel/gallery') }}/" + file.gallery_id + "/" + file.id + "/delete")
                    .then(function (response) {

                    })
                    .catch(function (error) {

                    });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });

        axios.get("{{ route('gallery.data.detail', $gallery_id) }}")
            .then(function (response) {
                if(response.status == 200){
                    let data = response.data.data;

                    if(data != null){
                        for (let i = 0; i < data.length; i++) {
                            const item = data[i];
                            const galleryId = item.gallery_id;
                            const fileId = item.id;
                            const fileName = item.image;
                            const fileSize = item.size;
                            const filePath = item.pathFile + "/" + fileName;
                            const emitFile = { id: fileId, name: fileName, size: fileSize, gallery_id: galleryId };

                            dropzone.displayExistingFile(emitFile, filePath);
                            dropzone.files.push(emitFile)
                        }
                    }
                }
            })
            .catch(function (error) {

            });

        ////////////
        // Events //
        ////////////
    });
</script>
@endpush
