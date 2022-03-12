@php
    $configSiteHelper = \App\Helpers\ConfigSiteHelper::instance();
    $socialMedia = $configSiteHelper->socialMedia();
@endphp

@extends('layouts.site.site-app')

@section('style')
<style>
    #carouselExampleIndicators > button {
        background: none;
        border: none;
    }

    .single-main-news {
        margin-bottom: 0px;
    }

    .single-main-news > a > img {
        height: 645px;
        width: 100%;
    }

    .slider-lead {
        color: white;
        width: 100%;
        display: block;
    }
    .single-main-news-inner > a > img {
        width: 100%;
    }
    .single-main-news-box img {
        height: 100%;
    }

    .most-popular-post {
        border: none !important;
    }
</style>
@endsection

@section('content')
<!-- Start Header Views -->
<section class="main-news-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    @if (!$newsBanner->isEmpty())
                    <div class="carousel-indicators">
                        @for ($i = 0; $i < count($newsBanner); $i++)
                        <button
                            type="button"
                            data-bs-target="#carouselAds"
                            data-bs-slide-to="{{ $i }}"
                            @if ($i == 0)
                            class="active"
                            @endif
                            aria-current="true"
                            aria-label="{{ $newsBanner[$i]->title }}"></button>
                        @endfor
                    </div>

                    {{-- List news header banner --}}
                    <div class="carousel-inner">
                        @for ($i = 0; $i < count($newsBanner); $i++)
                        @php
                            $item = $newsBanner[$i];
                            $bannerImageUrl = empty($item->banner) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/news/' . $item->banner;
                        @endphp
                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                            <div class="single-main-news">
                                <a href="{{ route('site.news.detail', $item) }}">
                                    <img src="{{ asset($bannerImageUrl) }}" data-original="{{ asset($bannerImageUrl) }}" alt="{{ $item->title }}">
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>

                    @if (count($newsBanner) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                    @endif
                </div>
            </div>

            @if (!$productBanner->isEmpty())
            <div class="col-lg-4">
                <div class="single-main-news-inner">
                    <div id="carouselAds" class="carousel slide" data-ride="carousel">
                        <div class="carousel-indicators">
                            @for ($i = 0; $i < count($productBanner); $i++)
                            <button
                                type="button"
                                data-bs-target="#carouselAds"
                                data-bs-slide-to="{{ $i }}"
                                @if ($i == 0)
                                class="active"
                                @endif
                                aria-current="true"
                                aria-label="{{ $productBanner[$i]->title }}"></button>
                            @endfor
                        </div>

                        {{-- List banner products --}}
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($productBanner); $i++)
                            @php
                                $item = $productBanner[$i];
                            @endphp
                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                <a href="{{ route('site.product.detail', $item) }}">
                                    <img class="img-fluid lazy"
                                        src="{{ asset('storage/images/product/' . $item->image) }}"
                                        data-original="{{ asset('storage/images/product/' . $item->image) }}"
                                        alt="{{ $item->title }}">
                                </a>
                            </div>
                            @endfor
                        </div>

                        @if (count($productBanner) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAds" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAds" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        @endif
                    </div>
                </div>

                {{-- Start list product top 3 --}}
                @foreach ($productTop3 as $item)
                <div class="single-main-news-box">
                    <a href="{{ route('site.product.detail', $item) }}">
                        <img
                            src="{{ asset('storage/images/product/' . $item->image) }}"
                            data-original=" {{ asset('storage/images/product/' . $item->image) }}"
                            class="img-fluid lazy"
                            width="100%"
                            height="100%"
                            alt="{{ $item->title }}">
                    </a>
                    <div class="news-content">
                        <div class="tag"><a href="{{ url('#') }}">PRODUK</a></div>
                        <h3  style="margin: 0px !important;"><a href="{{ route('site.product.detail', $item) }}">{{ $item->title }}</a></h3>
                        <span><a href="{{ url('#') }}">{{ $item->created_at->format(config('constants.DATE.DATE_SIMPLE')) }}</a></span>
                    </div>
                </div>
                @endforeach
                {{-- End list product top 3 --}}
            </div>
            @endif
        </div>
    </div>
</section>
<!-- End Header Views -->

<div class="sg-main-content mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8 sg-sticky">
                <div class="theiaStickySidebar">

                    @if (!$newsSideRight->isEmpty() || !$newsSideLeft->isEmpty())
                    <div class="most-popular-news">
                        <div class="section-title">
                            <h2>BERITA</h2>
                        </div>

                        <div class="row">
                            {{-- Section news 2 top --}}
                            <div class="col-lg-4">
                                @foreach ($newsSideRight as $item)
                                @php
                                    $bannerImageUrl = empty($item->banner) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/news/' . $item->banner;
                                @endphp
                                <div class="single-most-popular-news">
                                    <div class="popular-news-image">
                                        <a href="{{ route('site.news.detail', $item) }}">
                                            <img
                                                src="{{ asset($bannerImageUrl) }}"
                                                data-original="{{ asset($bannerImageUrl) }}"
                                                class="img-fluid"
                                                alt="{{ $item->title }}">
                                        </a>
                                    </div>

                                    <div class="popular-news-content">
                                        <span><a href="{{ route('site.news') }}">Berita</a></span>

                                        <h3 style="margin: 0px !important;">
                                            <a href="{{ route('site.news.detail', $item) }}">
                                                {{ $item->title }}
                                            </a>
                                        </h3>

                                        <p><a href="{{ url('#') }}">{{ $item->creator->name }}</a> / <a href="{{ url('#') }}"> {{ $item->created_at->format(config('constants.DATE.DATE_SIMPLE')) }}</a></p>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- Section news others --}}
                            <div class="col-lg-8">
                                @foreach ($newsSideLeft as $item)
                                @php
                                    $bannerImageUrl = empty($item->banner) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/news/' . $item->banner;
                                @endphp
                                <div class="most-popular-post">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="post-image">
                                                <a href="{{ route('site.news.detail', $item) }}">
                                                    <img
                                                        src="{{ asset($bannerImageUrl) }}"
                                                        data-original="{{ asset($bannerImageUrl) }}"
                                                        class="img-fluid" alt="{{ $item->title }}">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-sm-8">
                                            <div class="post-content">
                                                <span><a href="{{ route('site.news') }}">Berita</a></span>
                                                <h3 style="margin: 0px !important;">
                                                    <a href="{{ route('site.news.detail', $item) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                                <p><a href="{{ url('#') }}">{{ $item->creator->name }}</a> / <a href="{{ url('#') }}"> {{ $item->created_at->format(config('constants.DATE.DATE_SIMPLE')) }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (!$videos->isEmpty())
                    <div class="video-news">
                        <div class="section-title">
                            <h2>Video</h2>
                        </div>

                        <div class="video-slides owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                {{-- Section list video --}}
                                <div class="owl-stage">
                                    @foreach ($videos as $item)
                                    <div class="owl-item">
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

                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" role="presentation" class="owl-next"><i class="bx bx-chevron-right"></i></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                            <div class="text-right" style="padding:15px 0px; text-align: right">
                                <a href="{{ route('site.video') }}" class="btn btn-primary">Lihat Semua Video</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (!$galleryTop5->isEmpty())
                    <div class="video-news">
                        <div class="section-title">
                            <h2>Galeri</h2>
                        </div>

                        <div class="video-slides owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                {{-- Section Galery items --}}
                                <div class="owl-stage">
                                    @foreach ($galleryTop5 as $item)
                                    @if (!$item->images()->get()->isEmpty())
                                    @php
                                        $firstImage = $item->images()->first();
                                    @endphp
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="{{ route('site.gallery.detail', $item) }}">
                                                    <img src="{{ $configSiteHelper->generateAsset('gallery', $firstImage != null ? $firstImage->image : '') }}"/>
                                                </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="{{ route('site.gallery.detail', $item) }}">{{ $item->name }}</a>
                                                </h3>
                                                <span>{{ $item->created_at->format(config('constants.DATE.DATE_SIMPLE')) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" role="presentation" class="owl-next"><i class="bx bx-chevron-right"></i></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                            <div class="text-right" style="padding:15px 0px; text-align: right">
                                <a href="{{ route('site.gallery') }}" class="btn btn-primary">Lihat Semua Galeri</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            @include('layouts.site.widget.site-widget-col5-panduan-social_media', [
                'socialMedia' => $socialMedia
            ])
        </div>
    </div>
</div>
@endsection
