@php
    $configSite = \App\Helpers\ConfigSiteHelper::instance();
    $socialMedia = $configSite->socialMedia();
@endphp

@extends('layouts.site.site-app')

@section('content')
<div class="sg-page-content">
    <div class="container">
        <div class="entry-header mb-4">
            <div class="entry-thumbnail">
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 col-lg-8 sg-sticky">
                <div class="theiaStickySidebar post-details">
                    <div class="sg-section">
                        <div class="section-content">
                            <div class="sg-post">
                                <div class="entry-header">
                                    <div class="entry-thumbnail" height="100%">
                                        @if (empty($data->video_url))
                                        <img class="img-fluid"
                                            src="{{ $configSite->generateAsset('video', $data->banner) }}"
                                            data-original="{{ $configSite->generateAsset('video', $data->banner) }}"
                                            alt="{{ $data->title }}">
                                        @else
                                        @php
                                            $videoId = $configSite->getVideoIdYoutube($data->video_url);
                                        @endphp
                                        @if ($configSite->isVideoYoutube($data->video_url))
                                        <iframe width="100%" height="480" src="https://www.youtube.com/embed/{{ $videoId }}"></iframe>
                                        @else
                                        <img class="img-fluid"
                                            src="{{ $configSite->generateAsset('video', $data->banner) }}"
                                            data-original="{{ $configSite->generateAsset('video', $data->banner) }}"
                                            alt="{{ $data->title }}">
                                        @endif
                                        @endif
                                    </div>
                                </div>

                                <div class="entry-content p-4">
                                    <h3 class="entry-title">{{ $data->title }}</h3>
                                    <div class="entry-meta mb-2">
                                        <ul class="global-list">
                                            <li>
                                                <i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
                                                <a href="{{ url('#') }}">{{ $data->created_at->format(config('constants.DATE.DEFAULT')) }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="paragraph">
                                        {!! Markdown::convertToHtml($data->description) !!}
                                    </div>
                                    <div class="sg-inner-image m-2">
                                    </div>
                                </div>
                            </div>

                            <div class="sg-section">
                                <div class="section-content">
                                    <div class="section-title">
                                        <h1>Komentar</h1>
                                    </div>

                                    <form class="contact-form" name="contact-form" method="post" action="{{ route('site.video.detail.comment', $data) }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="four">Komentar</label>
                                                    <textarea
                                                        id="four"
                                                        name="comment"
                                                        required="required"
                                                        class="form-control"
                                                        rows="7"
                                                        placeholder="this is message..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Kirim Komentar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            @if (!$anotherVideo->isEmpty())
                            <div class="sg-section">
                                <div class="section-content">
                                    <div class="section-title">
                                        <h1>Video terkait</h1>
                                    </div>

                                    {{-- List Anothers Video --}}
                                    <div class="row text-center">
                                        @foreach ($anotherVideo as $item)
                                        <div class="col-lg-6">
                                            <div class="sg-post post-style-2">
                                                <div class="entry-header">
                                                    <div class="entry-thumbnail">
                                                        <a href="{{ route('site.video.detail', $item) }}">
                                                            <img
                                                                src="{{ $configSite->generateAssetVideoYoutube($item) }}"
                                                                data-original="{{ $configSite->generateAssetVideoYoutube($item) }}"
                                                                class="img-fluid"
                                                                alt="{{ $item->title }}">
                                                        </a>
                                                    </div>
                                                    <div class="category block">
                                                        <ul class="global-list">
                                                            <li><a href="{{ route('site.video') }}">Video</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="entry-content">
                                                    <h3 class="entry-title"><a href="{{ route('site.video.detail', $item) }}">{{ $item->title }}</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section social media --}}
            @include('layouts.site.widget.site-widget-col5-panduan-social_media', [
                'socialMedia' => $socialMedia
            ])
        </div>
    </div>
</div>
@endsection
