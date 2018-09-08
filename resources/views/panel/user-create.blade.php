@extends('layouts.app')

@section('title', 'Users: Create Data')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><i class="fa fa-th-list"></i> Form User Data</div>

            <form class="form-horizontal" action="{{ route('user.data.create') }}" method="post">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label is-required" for="input-name">Name</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="input-name" maxlength="191" value="{{ old('name') }}">
                            
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush