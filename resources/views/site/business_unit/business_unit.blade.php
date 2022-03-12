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
                                    <h3>{{ $data->title }}</h3>
                                    <div class="paragraph p-t-20">
                                        <p>{!! Markdown::convertToHtml($data->content) !!}</p>
                                    </div>
                                </div>
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
