@php
    $configSiteHelper = \App\Helpers\ConfigSiteHelper::instance();
    $socialMedia = $configSiteHelper->socialMedia();
@endphp

@extends('layouts.site.site-app')

@section('content')
<div class="sg-page-content">
    <div class="container">
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Video</h2>
                    <ul>
                        <li><a href="{{ url('') }}">Beranda</a></li>
                        <li>Video</li>
                    </ul>
                </div>
            </div>
        </div>
        <section class="default-news-area ptb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            @foreach ($data as $item)
                            <div class="col-md-4">
                                <div class="video-item">
                                    <div class="video-news-image">
                                        <a href="{{ route('site.video.detail', $item) }}">
                                            <img
                                                src="{{ $configSiteHelper->generateAssetVideoYoutube($item) }}"
                                                data-original="{{ $configSiteHelper->generateAssetVideoYoutube($item) }}"
                                                class="img-fluid"
                                                alt="{{ $item->title }}">
                                        </a>
                                    </div>
                                    <div class="video-news-content">
                                        <h3>
                                            <a href="{{ route('site.video.detail', $item) }}">{{ $item->title }}</a>
                                        </h3>
                                        <span>{{ $item->created_at->format(config('constants.DATE.DATE_SIMPLE')) }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
