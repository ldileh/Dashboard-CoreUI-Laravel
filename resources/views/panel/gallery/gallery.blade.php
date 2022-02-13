@extends('layouts.app')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/vex.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vex-theme-os.css') }}" />
@endsection

@section('extra-js')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('title', 'News')

@section('content')
@include('layouts.info-layout')

{{-- table list --}}
<div class="row">
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    <i class="icon icon-menu"></i> Data News
                </div>

                <a class="btn btn-primary btn-sm float-right" href="{{ route('news.create') }}"><i class="fa fa-plus"></i> Create News</a>
            </div>

            <div class="card-body">
                <table id="data-table" class="table table-responsive-sm" style="width:100%">
                    <thead>
                        <th width="50">No</th>
                        <th>Title</th>
                        <th width="200">Created At</th>
                        <th width="50" class="text-center">Action</th>
                    </thead>
                </table>
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

        ////////////
        // Events //
        ////////////
    });
</script>
@endpush
