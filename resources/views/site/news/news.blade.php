@php
    $socialMedia = \App\Helpers\ConfigSiteHelper::instance()->socialMedia();
@endphp

@extends('layouts.site.site-app')

@section('content')
<div class="sg-main-content mb-4">
    <div class="container" style="margin-top: 16px;">
        <div class="row">
            <div class="col-md-7 col-lg-8 sg-sticky">
                <div class="theiaStickySidebar">
                    <div class="sg-section">
                        <div class="section-content">
                            @if (!$news->isEmpty())
                            <div class="latest-post-area">
                                @foreach ($news as $item)
                                <div class="sg-post medium-post-style-1">
                                    <div class="entry-header">
                                        <div class="entry-thumbnail">
                                            <a href="{{ route('site.news.detail', $item) }}">
                                                @php
                                                    $bannerImageUrl = empty($item->banner) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/news/' . $item->banner;
                                                @endphp
                                                <img
                                                    src="{{ asset($bannerImageUrl) }}"
                                                    data-original="{{ asset($bannerImageUrl) }}"
                                                    class="img-fluid"
                                                    alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="entry-content align-self-center">
                                        <h3 class="entry-title">
                                            <a href="{{ route('site.news.detail', $item) }}">{{ $item->title }}</a>
                                        </h3>
                                        <div class="entry-meta mb-2">
                                            <ul class="global-list">
                                                <li>post oleh <a href="{{ url('#') }}">{{ $item->creator->name }}</a></li>
                                                <li><a href="{{ url('#') }}"> {{ $item->created_at->format(config('constants.DATE.DEFAULT')) }}</a></li>
                                            </ul>
                                        </div>
                                        <p>{{ \Illuminate\Support\Str::limit($item->description, 150, $end = '...') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                {{ $news->links() }}
                            </div>
                            @else
                            <div class="sg-post">
                                <div class="entry-content p-4">
                                    <div class="paragraph p-t-20">
                                        <p>Berita tidak ditemukan.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
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
