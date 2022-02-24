@php
    $socialMedia = \App\Helpers\ConfigSiteHelper::instance()->socialMedia();
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
                    @php
                        $newsFirst = $newsBanner->first();
                        $newsEnd = $newsBanner->last();
                    @endphp
                    <div class="carousel-indicators">
                        @if ($newsFirst != null)
                        <button
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="0"
                            class="active"
                            aria-current="true"
                            aria-label="{{ $newsFirst->title }}"></button>
                        @endif

                        @if ($newsEnd != null)
                        <button
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="{{ $newsBanner->count() - 1 }}"
                            aria-current="true"
                            aria-label="{{ $newsEnd->title }}"></button>
                        @endif
                    </div>

                    {{-- List news header banner --}}
                    <div class="carousel-inner">
                        @foreach ($newsBanner as $item)
                        @php
                            $bannerImageUrl = empty($item->banner) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/news/' . $item->banner;
                        @endphp
                        <div class="carousel-item {{ $item->index == 0 ? 'active' : '' }}">
                            <div class="single-main-news">
                                <a href="{{ route('site.news.detail', $item) }}">
                                    <img src="{{ asset($bannerImageUrl) }}" data-original="{{ asset($bannerImageUrl) }}" alt="{{ $item->title }}">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
            </div>

            @if (!$productBanner->isEmpty())
            <div class="col-lg-4">
                <div class="single-main-news-inner">
                    <div id="carouselAds" class="carousel slide" data-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselAds" data-bs-slide-to="0"  class="active" aria-current="true" aria-label=""></button>
                            <button type="button" data-bs-target="#carouselAds" data-bs-slide-to="1"  aria-current="true" aria-label=""></button>
                        </div>

                        {{-- List banner products --}}
                        <div class="carousel-inner">
                            @foreach ($productBanner as $item)
                            <div class="carousel-item {{ $item->index == 0 ? 'active' : '' }}">
                                <a href="{{ route('site.product.detail', $item->id) }}">
                                    <img class="img-fluid lazy"
                                        src="{{ asset('storage/images/product/' . $item->image) }}"
                                        data-original="{{ asset('storage/images/product/' . $item->image) }}"
                                        alt="{{ $item->title }}">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Start list product top 3 --}}
                @foreach ($productTop3 as $item)
                <div class="single-main-news-box">
                    <a href="{{ route('site.product.detail', $item->id) }}">
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
                        <h3  style="margin: 0px !important;"><a href="{{ route('site.product.detail', $item->id) }}">{{ $item->title }}</a></h3>
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
                                                <a href="http://dev.kpam.online/story/konferensi-pers-penyambutan-tim-aksi-jalan-kaki-tutuptpl-dari-toba-ke-jakarta">
                                                    <img
                                                        src="http://dev.kpam.online/default-image/default-358x215.png "
                                                        data-original=" http://dev.kpam.online/images/20210920134016_medium_358x215_2.webp "
                                                        class="img-fluid" alt="Konferensi Pers 'Penyambutan TIM Aksi Jalan Kaki #TutupTPL dari Toba ke Jakarta'">
                                                </a>
                                            </div>

                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/story/konferensi-pers-penyambutan-tim-aksi-jalan-kaki-tutuptpl-dari-toba-ke-jakarta">Konferensi Pers &quot;Penyambutan TIM Aksi Jalan Kaki #TutupTPL dari Toba ke Jakarta&quot;</a>
                                                </h3>
                                                <span>20 September 2021</span>
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
                                <a href="http://dev.kpam.online/list-videos" class="btn btn-primary">Lihat Semua Video</a>
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
                                                <a href="{{ route('site') }}">
                                                    @if ($firstImage != null)
                                                    <img src="{{ asset('storage/images/gallery' . $firstImage->image) }}"/>
                                                    @else
                                                    <img src=""/>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="{{ route('site') }}">{{ $item->name }}</a>
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
                                <a href="{{ route('site') }}" class="btn btn-primary">Lihat Semua Galeri</a>
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
