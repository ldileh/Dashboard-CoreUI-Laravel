@extends('layouts.site.site-app')

@section('content')
<div class="sg-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 sg-sticky">
                <div class="theiaStickySidebar post-details">
                    <div class="sg-section">
                        <div class="section-content">
                            <div class="sg-post">
                                <div class="entry-content p-4">
                                    <h3>Data Member | Disetujui</h3>

                                    @if (!$data->isEmpty())
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="50px">No.</th>
                                                <th>Nama</th>
                                                <th width="250px">Tanggal Registrasi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->index + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->created_at->format(config('constants.DATE.DEFAULT')) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="paragraph p-t-20">
                                        <p>Data Member Kosong...</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
