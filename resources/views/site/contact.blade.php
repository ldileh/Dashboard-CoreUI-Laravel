@extends('layouts.site.site-app')

@section('content')
    <div class="sg-page-content">
        <div class="container">
            <div class="page-title-area">
                <div class="container">
                    <div class="page-title-content">
                        <h2>{{__('contact_us')}}</h2>
                    </div>
                </div>
            </div>
            <br />
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="sg-section">
                                <div class="section-content">
                                    <div class="section-title">
                                        <h1>{{ __('send_a_message') }}</h1>
                                    </div><!-- /.section-title -->
                                    <form class="contact-form" name="contact-form" method="post" action="{{ route('site.contact')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="one">{{ __('name') }} *</label>
                                                    <input type="text" class="form-control" name="name" id="one" placeholder="{{__('input_user')}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="two">{{ __('email') }} *</label>
                                                    <input type="email" class="form-control" name="email" id="two" placeholder="{{__('input_email')}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="four">{{ __('message') }} *</label>
                                                    <textarea name="message" class="form-control" rows="7" id="four" placeholder="{{__('input_message')}}"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">{{ __('submit_now') }}</button>
                                        </div>
                                    </form>
                                </div><!-- /.section-content -->
                            </div><!-- /.sg-section -->
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="row">
                            <div class="theiaStickySidebar">
                                <div class="sg-section">
                                    <div class="section-content">
                                        <div class="widget-subscribe-content pt-2">
                                            <p style="color: black !important;">Kantor Pusat :</p>
                                            <p style="color: black !important;">Jl.Tebet Timur Dalam Raya No. 11 A RT 008 RW 004
                                                Kelurahan Tebet Timur Kecamatan Tebet,
                                                Jakarta Selatan, DKI Jakarta.</p>
                                            <p style="color: black !important;">Cabang :</p>
                                            <p style="color: black !important;">Jalan Jendral Sudirman No. 15F Bogor<br/>
                                                Telepon / Fax : +62 21 8297954 / +62 21 837 06282<br/>
                                                Email : kpam@aman.or.id<br/>
                                                Website : www.kpam.or.id
                                            </p><br/>
                                        </div>
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d126919.74888614261!2d106.854123!3d-6.231775!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x99ae357bf6658626!2sRumah%20AMAN%20(Indigenous%20Peoples%20Alliance%20of%20the%20Archipelago)!5e0!3m2!1sen!2sid!4v1624552079479!5m2!1sen!2sid"
                                             height="250" style="border:0; width: 100%" allowfullscreen="" loading="lazy"></iframe>
                                        <br />
                                        <br />
                                        <br />
                                        <br />
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

@section('script')
@endsection
