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
                        <li>Album</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row" style="padding-bottom: 24px;">
            @foreach ($data as $item)
            @php
                $firstImage = $item->images()->first();
                $banner = $firstImage != null ? $firstImage->image : '';
            @endphp
            <a href="{{ route('site.gallery.detail', $item) }}" class="col-4">
                <img src="{{ $configSiteHelper->generateAsset('gallery', $banner) }}"/>

                <div class="title">
                    <div class="album">{{ $item->name }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
