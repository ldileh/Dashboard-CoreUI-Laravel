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

@section('title', 'Member')

@section('content')
@include('layouts.info-layout')

{{-- table list --}}
<div class="row">
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    <i class="icon icon-menu"></i> Data Member
                </div>

                <a class="btn btn-primary btn-sm float-right" href="{{ route('member.create') }}" style="margin-left: 8px;"><i class="fa fa-plus"></i> Create Member</a>
                <a class="btn btn-primary btn-sm float-right" href="{{ route('pdf.members') }}" target="_blank"><i class="fa fa-download"></i> Import All</a>
            </div>

            <div class="card-body">
                <table id="data-table" class="table table-responsive-sm" style="width:100%">
                    <thead>
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th width="50">Status</th>
                        <th width="200">Join At</th>
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

        // do request data table
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('member.data') !!}',
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false ,width: '50px'},
                { data: 'name', name: 'name' },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta){
                        return '<span class="badge '+row.badge_color+'">'+data+'</span>';
                    }
                },
                { data: 'created_at', name: 'created_at' },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta){
                        if(row.member_status_id == "{{ config('constants.MEMBER.STATUS.REGISTER') }}"){
                            return '<div class="btn-group btn-group-sm">' +
                            '<button type="button" class="btn btn-danger button-delete" data-value="'+data+'"><i class="fa fa-trash"></i></button>' +
                            '<button type="button" class="btn btn-warning button-update-status" data-value="'+data+'" data-name="'+row.name+'"><i class="fa fa-exchange" style="color: white;"></i></button>' +
                            '<a class="btn btn-primary" href="{{ url('panel/member') }}/'+data+'/edit"><i class="fa fa-pencil"></i></a>' +
                            '<a class="btn btn-primary" href="'+ row.member_url_print +'" target="_blank"><i class="fa fa-print"></i></a>' +
                        '</div>';
                        }else{
                            return '<div class="btn-group btn-group-sm">' +
                            '<button type="button" class="btn btn-danger button-delete" data-value="'+data+'"><i class="fa fa-trash"></i></button>' +
                            '<a class="btn btn-primary" href="{{ url('panel/member') }}/'+data+'/edit"><i class="fa fa-pencil"></i></a>' +
                            '<a class="btn btn-secondary" href="'+ row.member_url_print +'" target="_blank"><i class="fa fa-print"></i></a>' +
                        '</div>';
                        }
                    }
                },
            ],
            'columnDefs': [
                {
                    'targets': 3,
                    'className': 'text-center',
                }
            ]
        });

        ////////////
        // Events //
        ////////////

        $('#data-table tbody').on('click', '.button-delete', function(){
            var value = $(this).data('value');

            vex.dialog.confirm({
                message: 'Anda yakin untuk menghapus data ini?',
                callback: function (responseDialog) {
                    if (responseDialog) {
                        // do request endpoint...
                        showLoading();
                        axios.delete("{{ url('panel/member') }}/" + value + "/delete")
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

        $('#data-table tbody').on('click', '.button-update-status', function(){
            var value = $(this).data('value');
            var name = $(this).data('name');

            vex.dialog.confirm({
                message: 'Anda yaking untuk menyetujui data member ('+ name +') ini?',
                callback: function (responseDialog) {
                    if (responseDialog) {
                        // do request endpoint...
                        showLoading();
                        axios.put("{{ url('panel/member') }}/" + value + "/status/change")
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
    });
</script>
@endpush
