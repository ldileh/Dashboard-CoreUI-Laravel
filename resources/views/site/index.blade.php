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
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="0"  class="active"
                            aria-current="true"
                            aria-label="Desa pertanian dan koperasi di Israel"></button>

                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="1"  aria-current="true"
                            aria-label="Membangun koperasi dengan sederhana"></button>
                    </div>

                    {{-- List news header banner --}}
                    <div class="carousel-inner">
                        <div class="carousel-item active ">
                            <div class="single-main-news">
                                <a href="http://dev.kpam.online/story/Berita">
                                    <img src="http://dev.kpam.online/default-image/default-1080x1000.png" data-original="http://dev.kpam.online/images/20210625073618_big_1080x1000_49.webp " alt="Desa pertanian dan koperasi di Israel">
                                </a>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="single-main-news">
                                <a href="http://dev.kpam.online/story/membangun-koperasi-dengan-sederhana">
                                    <img src="http://dev.kpam.online/default-image/default-1080x1000.png " data-original="http://dev.kpam.online/images/20211208123216_big_1080x1000_21.webp " alt="Membangun koperasi dengan sederhana">
                                </a>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="single-main-news-inner">
                    <div id="carouselAds" class="carousel slide" data-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselAds" data-bs-slide-to="0"  class="active" aria-current="true" aria-label=""></button>
                            <button type="button" data-bs-target="#carouselAds" data-bs-slide-to="1"  aria-current="true" aria-label=""></button>
                        </div>

                        {{-- List banner products --}}
                        <div class="carousel-inner">
                            <div class="carousel-item  active ">
                                <a href="http://dev.kpam.online/amanregister">
                                    <img class="img-fluid lazy"
                                        src="http://dev.kpam.online/default-image/default-ads-550x368.jpg "
                                        data-original="http://dev.kpam.online/images/20211209112945_original_7.webp"
                                        alt="Headline">
                                </a>
                            </div>

                            <div class="carousel-item ">
                                <a href="#">
                                    <img class="img-fluid lazy"
                                        src="http://dev.kpam.online/default-image/default-ads-550x368.jpg "
                                        data-original="http://dev.kpam.online/images/20211209114147_original_45.webp"
                                        alt="Headline">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Start list product top 3 --}}
                <div class="single-main-news-box">
                    <a href="http://dev.kpam.online/story/nusantara-kita">
                        <img src="http://dev.kpam.online/default-image/default-123x83.png" data-original=" http://dev.kpam.online/images/20211209111558_small_123x83_4.webp " class="img-fluid lazy" width="100%" height="100%" alt="Nusantara Kita">
                    </a>
                    <div class="news-content">
                        <div class="tag">
                            <a href="http://dev.kpam.online/category/produk">PRODUK</a>
                        </div>

                        <h3  style="margin: 0px !important;">
                            <a href="http://dev.kpam.online/story/nusantara-kita">Nusantara Kita</a>
                        </h3>

                        <span>
                            <a href="http://dev.kpam.online/date/2021-12-09">December 9, 2021</a>
                        </span>
                    </div>
                </div>

                <div class="single-main-news-box">
                    <a href="http://dev.kpam.online/story/http://www.gerainusantara.com">
                        <img src="http://dev.kpam.online/default-image/default-123x83.png "
                            data-original=" http://dev.kpam.online/images/20211209103333_small_123x83_47.webp "
                            class="img-fluid lazy" width="100%" height="100%" alt="Gerai Nusantara">
                    </a>

                    <div class="news-content">
                        <div class="tag">
                            <a href="http://dev.kpam.online/category/produk">PRODUK</a>
                        </div>

                        <h3  style="margin: 0px !important;">
                            <a href="http://dev.kpam.online/story/http://www.gerainusantara.com">Gerai Nusantara</a>
                        </h3>
                        <span>
                            <a href="http://dev.kpam.online/date/2021-12-09">December 9, 2021</a>
                        </span>
                    </div>
                </div>

                <div class="single-main-news-box">
                    <a href="http://dev.kpam.online/story/nusantara-indigenous-coffee">
                        <img src="http://dev.kpam.online/default-image/default-123x83.png "
                            data-original=" http://dev.kpam.online/images/20211209110109_small_123x83_50.webp "
                            class="img-fluid lazy" width="100%" height="100%" alt="Nusantara Indigenous Coffee">
                    </a>

                    <div class="news-content">
                        <div class="tag">
                            <a href="http://dev.kpam.online/category/produk">PRODUK</a>
                        </div>

                        <h3  style="margin: 0px !important;">
                            <a href="http://dev.kpam.online/story/nusantara-indigenous-coffee">Nusantara Indigenous Coffee</a>
                        </h3>
                        <span>
                            <a href="http://dev.kpam.online/date/2021-12-09">December 9, 2021</a>
                        </span>
                    </div>
                </div>
                {{-- End list product top 3 --}}
            </div>
        </div>
    </div>
</section>
<!-- End Header Views -->

<div class="sg-main-content mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8 sg-sticky">
                <div class="theiaStickySidebar">
                    <div class="most-popular-news">
                        <div class="section-title">
                            <h2>BERITA</h2>
                        </div>

                        <div class="row">
                            {{-- Section news 2 top --}}
                            <div class="col-lg-4">
                                <div class="single-most-popular-news">
                                    <div class="popular-news-image">
                                        <a href="http://dev.kpam.online/story/duduk-manis-di-pangkuan-kapitalisme">
                                            <img
                                                src="http://dev.kpam.online/default-image/default-358x215.png "
                                                data-original=" http://dev.kpam.online/images/20211220105634_medium_358x215_24.webp "
                                                class="img-fluid" alt="Duduk manis di pangkuan kapitalisme">
                                        </a>
                                    </div>

                                    <div class="popular-news-content">
                                        <span><a href="http://dev.kpam.online/category/berita">Berita</a></span>

                                        <h3 style="margin: 0px !important;">
                                            <a href="http://dev.kpam.online/story/duduk-manis-di-pangkuan-kapitalisme">
                                                Duduk manis di pangkuan k...
                                            </a>
                                        </h3>

                                        <p><a href="http://dev.kpam.online/author-profile/2">admin</a> / <a href="http://dev.kpam.online/date/2021-12-20"> 20 December 2021</a></p>
                                    </div>
                                </div>

                                <div class="single-most-popular-news">
                                    <div class="popular-news-image">
                                        <a href="http://dev.kpam.online/story/Berita">
                                            <img
                                                src="http://dev.kpam.online/default-image/default-358x215.png "
                                                data-original=" http://dev.kpam.online/images/20210625073618_medium_358x215_16.webp "
                                                class="img-fluid" alt="Desa pertanian dan koperasi di Israel">
                                        </a>
                                    </div>

                                    <div class="popular-news-content">
                                        <span><a href="http://dev.kpam.online/category/berita">Berita</a></span>
                                        <h3 style="margin: 0px !important;">
                                            <a href="http://dev.kpam.online/story/Berita">
                                                Desa pertanian dan kopera...
                                            </a>
                                        </h3>
                                        <p>
                                            <a href="http://dev.kpam.online/author-profile/2">admin</a> / <a href="http://dev.kpam.online/date/2021-12-08"> 8 December 2021</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Section news others --}}
                            <div class="col-lg-8">
                                <div class="most-popular-post">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="post-image">
                                                <a href="http://dev.kpam.online/story/membangun-koperasi-dengan-sederhana">
                                                    <img
                                                        src="http://dev.kpam.online/default-image/default-358x215.png "
                                                        data-original=" http://dev.kpam.online/images/20211208123216_medium_358x215_22.webp "
                                                        class="img-fluid" alt="Membangun koperasi dengan sederhana">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-sm-8">
                                            <div class="post-content">
                                                <span><a
                                                        href="http://dev.kpam.online/category/berita">Berita</a></span>
                                                <h3 style="margin: 0px !important;">
                                                    <a href="http://dev.kpam.online/story/membangun-koperasi-dengan-sederhana">
                                                        Membangun koperasi dengan sederhana
                                                    </a>
                                                </h3>
                                                <p>
                                                    <a href="http://dev.kpam.online/author-profile/1">ABDULAH</a>
                                                    / <a
                                                        href="http://dev.kpam.online/date/2021-12-08"> December 8, 2021</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="most-popular-post">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="post-image">
                                                <a href="http://dev.kpam.online/story/metamorfosa-sempurna-oligarkhi">
                                                    <img
                                                        src="http://dev.kpam.online/default-image/default-358x215.png "
                                                        data-original=" http://dev.kpam.online/images/20211220104100_medium_358x215_10.webp "
                                                        class="img-fluid" alt="Metamorfosa sempurna OLIGARKHI">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-sm-8">
                                            <div class="post-content">
                                                <span><a
                                                        href="http://dev.kpam.online/category/berita">Berita</a></span>
                                                <h3 style="margin: 0px !important;">
                                                    <a href="http://dev.kpam.online/story/metamorfosa-sempurna-oligarkhi">
                                                        Metamorfosa sempurna OLIGARKHI
                                                    </a>
                                                </h3>
                                                <p>
                                                    <a href="http://dev.kpam.online/author-profile/1">ABDULAH</a>
                                                    / <a
                                                        href="http://dev.kpam.online/date/2021-12-20"> December 20, 2021</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="most-popular-post">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="post-image">
                                                <a href="http://dev.kpam.online/story/utang">
                                                    <img
                                                    src="http://dev.kpam.online/default-image/default-358x215.png "
                                                    data-original=" http://dev.kpam.online/images/20211220103350_medium_358x215_27.webp "
                                                    class="img-fluid" alt="Utang">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-sm-8">
                                            <div class="post-content">
                                                <span><a
                                                        href="http://dev.kpam.online/category/berita">Berita</a></span>
                                                <h3 style="margin: 0px !important;">
                                                    <a href="http://dev.kpam.online/story/utang">
                                                        Utang
                                                    </a>
                                                </h3>
                                                <p>
                                                    <a href="http://dev.kpam.online/author-profile/1">ABDULAH</a>
                                                    / <a
                                                        href="http://dev.kpam.online/date/2021-12-20"> December 20, 2021</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="most-popular-post">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="post-image">
                                                <a href="http://dev.kpam.online/story/tanah-di-wilayah-adat-kalang-maghit-bukan-aset-pemda-manggarai-timur">
                                                    <img
                                                        src="http://dev.kpam.online/default-image/default-358x215.png "
                                                        data-original=" http://dev.kpam.online/images/20210616131138_medium_358x215_12.webp "
                                                        class="img-fluid" alt="Tanah di Wilayah Adat Kalang Maghit Bukan Aset Pemda Manggarai Timur">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-sm-8">
                                            <div class="post-content">
                                                <span><a
                                                        href="http://dev.kpam.online/category/berita">Berita</a></span>
                                                <h3 style="margin: 0px !important;">
                                                    <a href="http://dev.kpam.online/story/tanah-di-wilayah-adat-kalang-maghit-bukan-aset-pemda-manggarai-timur">
                                                        Tanah di Wilayah Adat Kalang Maghit Buka...
                                                    </a>
                                                </h3>
                                                <p>
                                                    <a href="http://dev.kpam.online/author-profile/1">ABDULAH</a>
                                                    / <a
                                                        href="http://dev.kpam.online/date/2021-06-16"> June 16, 2021</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="video-news">
                        <div class="section-title">
                            <h2>Video</h2>
                        </div>

                        <div class="video-slides owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                {{-- Section list video --}}
                                <div class="owl-stage">
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/story/konferensi-pers-penyambutan-tim-aksi-jalan-kaki-tutuptpl-dari-toba-ke-jakarta">
                                                    <img
                                                        src="http://dev.kpam.online/default-image/default-358x215.png "
                                                        data-original=" http://dev.kpam.online/images/20210920134016_medium_358x215_2.webp "
                                                        class="img-fluid" alt="Konferensi Pers "Penyambutan TIM Aksi Jalan Kaki #TutupTPL dari Toba ke Jakarta"">
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
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/story/vaksin-untuk-melindungi-diri-dan-masyarakat-adat">
                                                    <img
                                                        src="http://dev.kpam.online/default-image/default-358x215.png "
                                                        data-original=" http://dev.kpam.online/images/20210920133817_medium_358x215_29.webp "
                                                        class="img-fluid" alt="Vaksin untuk Melindungi Diri dan Masyarakat Adat">
                                                </a>
                                            </div>

                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/story/vaksin-untuk-melindungi-diri-dan-masyarakat-adat">Vaksin untuk Melindungi Diri dan Masyarakat Adat</a>
                                                </h3>
                                                <span>20 September 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/story/hari-internasional-masyarakat-adat-sedunia-himas-2021">
                                                                                            <img
                                                            src="http://dev.kpam.online/default-image/default-358x215.png "
                                                            data-original=" http://dev.kpam.online/images/20210920133647_medium_358x215_27.webp "
                                                            class="img-fluid" alt="Hari Internasional Masyarakat Adat Sedunia (HIMAS) 2021">
                                                                                    </a>
                                            </div>

                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/story/hari-internasional-masyarakat-adat-sedunia-himas-2021">Hari Internasional Masyarakat Adat Sedunia (HIMAS) 2021</a>
                                                </h3>
                                                <span>20 September 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/story/14-tahun-undrip-deklarasi-pbb-tentang-hak-hak-masyarakat-adat">
                                                    <img
                                                        src="http://dev.kpam.online/default-image/default-358x215.png "
                                                        data-original=" http://dev.kpam.online/images/20210920133455_medium_358x215_15.webp "
                                                        class="img-fluid" alt="14 Tahun UNDRIP - Deklarasi PBB tentang Hak-hak Masyarakat Adat.">
                                                </a>
                                            </div>

                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/story/14-tahun-undrip-deklarasi-pbb-tentang-hak-hak-masyarakat-adat">14 Tahun UNDRIP - Deklarasi PBB tentang Hak-hak Masyarakat Adat.</a>
                                                </h3>
                                                <span>20 September 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/story/hutan-titipan-dirusak-begini-pesan-baduy-dalam">
                                                    <img
                                                    src="http://dev.kpam.online/default-image/default-358x215.png "
                                                    data-original=" http://dev.kpam.online/images/20210920132958_medium_358x215_33.webp "
                                                    class="img-fluid" alt="Hutan Titipan Dirusak, Begini Pesan Baduy Dalam">
                                                </a>
                                            </div>

                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/story/hutan-titipan-dirusak-begini-pesan-baduy-dalam">Hutan Titipan Dirusak, Begini Pesan Baduy Dalam</a>
                                                </h3>
                                                <span>20 September 2021</span>
                                            </div>
                                        </div>
                                    </div>
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

                    <div class="video-news">
                        <div class="section-title">
                            <h2>Galeri</h2>
                        </div>

                        <div class="video-slides owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                {{-- Section Galery items --}}
                                <div class="owl-stage">
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/kerajinan-rotan">
                                                                                            <img src="http://dev.kpam.online/images/20211208120148_galleryImage_big19.jpg"/>
                                                                                    </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/kerajinan-rotan">Kerajinan Rotan</a>
                                                </h3>
                                                <span>20 December 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/kunjungan">
                                                                                            <img src="http://dev.kpam.online/images/20210920134332_galleryImage_big42.jpg"/>
                                                                                    </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/kunjungan">Kunjungan</a>
                                                </h3>
                                                <span>20 September 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/panen-kopi">
                                                                                            <img src="http://dev.kpam.online/images/20211219211826_galleryImage_big5.jpg"/>
                                                                                    </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/panen-kopi">Panen Kopi</a>
                                                </h3>
                                                <span>19 December 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/petani-kopi">
                                                                                            <img src="http://dev.kpam.online/images/20211219212054_galleryImage_big31.jpg"/>
                                                                                    </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/petani-kopi">Petani Kopi</a>
                                                </h3>
                                                <span>19 December 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/pameran-gerai-nusantara">
                                                                                            <img src="http://dev.kpam.online/images/20211219212529_galleryImage_big19.jpg"/>
                                                                                    </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/pameran-gerai-nusantara">Pameran Gerai Nusantara</a>
                                                </h3>
                                                <span>19 December 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/kunjungan-damannas">
                                                                                            <img src="http://dev.kpam.online/images/20211219212804_galleryImage_big1.jpg"/>
                                                                                    </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/kunjungan-damannas">Kunjungan DAMANNAS</a>
                                                </h3>
                                                <span>19 December 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/nusantara-Indigenous-Coffee">
                                                                                            <img src="http://dev.kpam.online/images/20211219212936_galleryImage_big49.jpg"/>
                                                                                    </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/nusantara-Indigenous-Coffee">Nusantara Indigenous Coffee</a>
                                                </h3>
                                                <span>20 December 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="video-item">
                                            <div class="video-news-image">
                                                <a href="http://dev.kpam.online/album-gallery/tenun">
                                                    <img src="http://dev.kpam.online/images/20211219213836_galleryImage_big3.jpg"/>
                                                </a>
                                            </div>
                                            <div class="video-news-content">
                                                <h3>
                                                    <a href="http://dev.kpam.online/album-gallery/tenun">Tenun</a>
                                                </h3>
                                                <span>19 December 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" role="presentation" class="owl-next"><i class="bx bx-chevron-right"></i></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                            <div class="text-right" style="padding:15px 0px; text-align: right">
                                <a href="http://dev.kpam.online/albums" class="btn btn-primary">Lihat Semua Galeri</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-lg-4 sg-sticky">
                <div class="sg-sidebar theiaStickySidebar">
                    <aside class="widget-area">
                        <section class="widget widget_featured_reports">
                            <div class="single-featured-reports">
                                <div class="featured-reports-image">
                                    <a href="http://dev.kpam.online/aman/panduan_singkat_kpam.pdf" target="_blank">
                                        <img src="http://dev.kpam.online/aman/foto_buku_panduan.png" alt="image">
                                    </a>
                                </div>
                            </div>
                        </section>

                        <section class="widget widget_stay_connected">
                            <h3 class="section-title">Tetap Terhubung</h3>
                            {{-- Section social medias --}}
                            <ul class="stay-connected-list">
                                <li class="facebook">
                                    <a href="#" style="background:#056ED8" name="Facebook">
                                        <span style="background:#0061C2">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </span>
                                        Facebook
                                    </a>
                                </li>
                                <li class="facebook">
                                    <a href="#" style="background:#E50017" name="Youtube">
                                        <span style="background:#FE031C">
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        </span>
                                        Youtube
                                    </a>
                                </li>
                                <li class="facebook">
                                    <a href="#" style="background:#349AFF" name="Twitter">
                                        <span style="background:#2391FF">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </span>
                                        Twitter
                                    </a>
                                </li>
                                <li class="facebook">
                                    <a href="#" style="background:#349affd9" name="Linkedin">
                                        <span style="background:#349AFF">
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        </span>
                                        Linkedin
                                    </a>
                                </li>
                                <li class="facebook">
                                    <a href="#" style="background:#4BA3FC" name="Skype">
                                        <span style="background:#4ba3fcd9">
                                            <i class="fa fa-skype" aria-hidden="true"></i>
                                        </span>
                                        Skype
                                    </a>
                                </li>
                                <li class="facebook">
                                    <a href="#" style="background:#c2000dd9" name="Pinterest">
                                        <span style="background:#C2000D">
                                            <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                                        </span>
                                        Pinterest
                                    </a>
                                </li>
                            </ul>
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
