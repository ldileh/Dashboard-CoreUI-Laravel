@php
    $socialMedia = \App\Helpers\ConfigSiteHelper::instance()->footerSocialMedia();
@endphp

<!-- Start Footer Area -->
<section class="footer-area" style="background-color: #00542a; padding-top:60px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="single-footer-widget">
                    <div class="card mb-3" style="background: none !important; border: none !important;">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="{{ route('site') }}">
                                        <img src="{{ asset('img/kpam-logo-medium.png') }}" width="100%" alt="Logo">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <h4 style="color: white">Koperasi Produsen AMAN Mandiri</h4>
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="widget-subscribe-content pt-2">
                                <p style="color: white !important;">Kantor Pusat :</p>
                                <p style="color: white !important;" class="paragraph-style">Jl.Tebet Timur Dalam Raya No. 11 A RT 008 RW 004
                                    Kelurahan Tebet Timur Kecamatan Tebet,
                                    Jakarta Selatan, DKI Jakarta.</p>
                                <p style="color: white !important;">Cabang :</p>
                                <p style="color: white !important;" class="paragraph-style">Jalan Jendral Sudirman No. 15F Bogor<br/>
                                    Telepon / Fax : +62 21 8297954 / +62 21 837 06282<br/>
                                    Email : kpam@aman.or.id<br/>
                                    Website : www.kpam.co.id
                                </p>
                            </div>
                            <div class="single-footer-widget">
                                <ul class="social">
                                    @foreach($socialMedia as $item)
                                        <li class="facebook">
                                            <a href="{{ $item['url'] }}" name="{{$item['name']}}">
                                                <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row pt-3">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d126919.74888614261!2d106.854123!3d-6.231775!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x99ae357bf6658626!2sRumah%20AMAN%20(Indigenous%20Peoples%20Alliance%20of%20the%20Archipelago)!5e0!3m2!1sen!2sid!4v1624552079479!5m2!1sen!2sid"
                                width="400" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- End Footer Area -->

