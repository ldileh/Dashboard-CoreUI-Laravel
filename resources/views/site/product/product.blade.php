@php
    $configSiteHelper = \App\Helpers\ConfigSiteHelper::instance();
    $socialMedia = $configSiteHelper->socialMedia();
@endphp

@extends('layouts.site.site-app')

@section('content')
<div class="sg-main-content mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8 sg-sticky">
                <div class="theiaStickySidebar">
                    <div class="sg-section">
                        <div class="section-content">
                            <div class="latest-post-area">

                                @foreach ($data as $item)
                                <div class="sg-post medium-post-style-1">
                                    <div class="entry-header">
                                        <div class="entry-thumbnail">
                                            <a href="{{ route('site.product.detail', $item) }}">
                                                <img
                                                    class="img-fluid"
                                                    src="{{ $configSiteHelper->generateAsset('product', $item->image) }}"
                                                    data-original="{{ $configSiteHelper->generateAsset('product', $item->image) }}"
                                                    alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="entry-content align-self-center">
                                        <h3 class="entry-title">
                                            <a href="{{ route('site.product.detail', $item) }}">{{ $item->title }}</a>
                                        </h3>
                                        {{-- <div class="entry-meta mb-2">
                                            <ul class="global-list">
                                                <li>post oleh <a href="{{ url('#') }}">{{ $item->creator->name }}</a></li>
                                                <li><a href="{{ url('#') }}"> {{ $item->created_at->format(config('constants.DATE.DEFAULT')) }}</a></li>
                                            </ul>
                                        </div>
                                        <p>{{ \Illuminate\Support\Str::limit($item->description, 150, $end = '...') }}</p> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.site.widget.site-widget-col5-panduan-social_media', [
                'socialMedia' => $socialMedia
            ])
        </div>
    </div>
</div>
@endsection
