@extends('layouts.app')

@section('title', 'Users')

@section('content')
@include('layouts.info-layout')

{{-- table list --}}
<div class="row">
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    <i class="icon icon-menu"></i> Data User
                </div>
                
                <a class="btn btn-primary btn-sm float-right" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Create User</a>
            </div>

            <div class="card-body">
                <table id="data-table" class="table table-responsive-sm" style="width:100%">
                    <thead>
                        <th width="50">No</th>
                        <th width="200">Name</th>
                        <th>Email</th>
                        <th width="80">Role</th>
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
            ajax: '{!! route('user.data') !!}',
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false ,width: '50px'},
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { 
                    data: 'user_role', 
                    name: 'user_roles.name', 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row, meta){
                        return '<span class="badge badge-success">'+data+'</span>';
                    }
                },
                { 
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta){
                        return '<div class="btn-group btn-group-sm">' +
                            '<button type="button" class="btn btn-danger button-delete" data-value="'+data+'"><i class="fa fa-trash"></i></button>' +
                            '<a class="btn btn-primary" href="{{ url('panel/users') }}/'+data+'/edit"><i class="fa fa-pencil"></i></a>' +
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
                        axios.delete("{{ url('panel/users') }}/" + value + "/delete")
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