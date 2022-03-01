@php
    $configSiteHelper = \App\Helpers\ConfigSiteHelper::instance();
@endphp

@extends('layouts.site.site-app')

@section('content')
<div class="sg-page-content">
    <div class="container">
        <div class="page-title-area" style="margin-bottom: 24px;">
            <div class="container">
                <div class="page-title-content">
                    <h2>Album</h2>
                    <ul>
                        <li><a href="{{ url('') }}">Beranda</a></li>
                        <li><a href="{{ route('site.gallery') }}">Album</a></li>
                        <li>{{ $data->name }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row" style="padding-bottom: 24px;">
            @foreach ($data->images()->get() as $item)
            <div class="col-6">
                <img src="{{ $configSiteHelper->generateAsset('gallery', $item->image) }}"/>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
