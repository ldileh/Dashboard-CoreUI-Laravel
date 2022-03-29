<div class="col-md-5 col-lg-4 sg-sticky">
    <div class="sg-sidebar theiaStickySidebar">
        <aside class="widget-area">
            <section class="widget widget_featured_reports">
                <div class="single-featured-reports">
                    <div class="featured-reports-image">
                        <a href="{{ asset('site/document/panduan_singkat_kpam.pdf') }}" target="_blank">
                            <img src="{{ asset('site/images/foto_buku_panduan.png') }}" alt="image">
                        </a>
                    </div>
                </div>
            </section>

            @if (!empty($socialMedia))
            <section class="widget widget_stay_connected">
                <h3 class="section-title">Tetap Terhubung</h3>
                {{-- Section social medias --}}
                <ul class="stay-connected-list">
                    @foreach ($socialMedia as $item)
                    <li class="facebook">
                        <a href="{{ $item['url'] }}" style="background:{{ $item['color'] }}" name="{{ $item['name'] }}">
                            <span style="background:{{ $item['color'] }}">
                                <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
                            </span>
                            {{ $item['name'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </section>
            @endif
        </aside>
    </div>
</div>
