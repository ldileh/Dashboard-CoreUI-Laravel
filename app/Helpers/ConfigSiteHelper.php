<?php

namespace App\Helpers;

use App\Models\Video;

class ConfigSiteHelper{

    public static function instance()
    {
        return new ConfigSiteHelper();
    }

    public function menus()
    {
        return [
            [
                'title' => 'Beranda',
                'url' => route('site'),
                'target' => '_self'
            ],
            [
                'title' => 'Berita',
                'url' => route('site.news'),
                'target' => '_self'
            ],
            [
                'title' => 'Organisasi',
                'url' => url('#'),
                'target' => '',
                'child' => [
                    [
                        'title' => 'Profile',
                        'url' => route('site.organization.profile'),
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Peraturan',
                        'url' => route('site.organization.rule'),
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Laporan',
                        'url' => route('site.organization.report'),
                        'target' => '_self'
                    ],
                ]
            ],
            [
                'title' => 'Anggota',
                'url' => url('#'),
                'target' => '',
                'child' => [
                    [
                        'title' => 'Data Anggota',
                        'url' => route('site.member.list'),
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Pendaftaran Anggota',
                        'url' => route('site.member.register'),
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Iuran Anggota',
                        'url' => route('site.member.constribution'),
                        'target' => '_self'
                    ],
                ]
            ],
            [
                'title' => 'Unit Usaha',
                'url' => url('#'),
                'target' => '',
                'child' => [
                    [
                        'title' => 'Nasional',
                        'url' => url('#'),
                        'target' => '_self',
                        'child' => [
                            [
                                'title' => 'Gerai Nusantara',
                                'url' => 'http://www.gerainusantara.com/',
                                'target' => '_self'
                            ],
                            [
                                'title' => 'Nusantara Indigineous Coffee',
                                'url' => 'https://www.instagram.com/indigenous_coffee/?hl=en',
                                'target' => '_self'
                            ],
                            [
                                'title' => 'Wisata Adat Nusantara Kita',
                                'url' => url('#'),
                                'target' => '_self'
                            ],
                            [
                                'title' => 'Pinjaman Modal Usaha Cabang dan Anggota PMUCA',
                                'url' => url('#'),
                                'target' => '_self'
                            ],
                        ]
                    ],
                    [
                        'title' => 'Wilayah',
                        'url' => url('#'),
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Daerah',
                        'url' => url('#'),
                        'target' => '_self'
                    ],[
                        'title' => 'Komunitas',
                        'url' => url('#'),
                        'target' => '_self'
                    ],
                ]
            ],

            [
                'title' => 'Kontak Kami',
                'url' => route('site.contact'),
                'target' => '_self'
            ],
        ];
    }

    public function socialMedia()
    {
        return [
            [
                'name' => 'Facebook',
                'url' => url('#'),
                'icon' => 'fa fa-facebook',
                'iconUrl' => '',
                'color' => '#056ED8'
            ],
            [
                'name' => 'Youtube',
                'url' => url('#'),
                'icon' => 'fa fa-youtube-play',
                'iconUrl' => '',
                'color' => '#E50017'
            ],
            [
                'name' => 'Twitter',
                'url' => url('#'),
                'icon' => 'fa fa-twitter',
                'iconUrl' => '',
                'color' => '#2391FF'
            ],
            [
                'name' => 'Linkedin',
                'url' => url('#'),
                'icon' => 'fa fa-linkedin',
                'iconUrl' => '',
                'color' => '#349affd9'
            ],
            [
                'name' => 'Skype',
                'url' => url('#'),
                'icon' => 'fa fa-skype',
                'iconUrl' => '',
                'color' => '#4ba3fcd9'
            ],
            [
                'name' => 'Pinterest',
                'url' => url('#'),
                'icon' => 'fa fa-pinterest-square',
                'iconUrl' => '',
                'color' => '#c2000dd9'
            ],
        ];
    }

    public function generateAsset($type, $fileName)
    {
        if($type == 'news'){
            return asset(empty($fileName) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/news/' . $fileName);
        }else if($type == 'product'){
            return asset(empty($fileName) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/product/' . $fileName);
        }else if($type == 'video'){
            return asset(empty($fileName) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/video/' . $fileName);
        }else if($type == 'gallery'){
            return asset(empty($fileName) ? 'site/img/main-news/main-news-1.jpg' : 'storage/images/gallery/' . $fileName);
        }else{
            return asset('site/img/main-news/main-news-1.jpg');
        }
    }

    public function generateAssetVideoYoutube(Video $video)
    {
        if(!empty($video->video_url) && strpos($video->video_url, 'youtube.com')){
            $container = [];
            parse_str( parse_url( $video->video_url, PHP_URL_QUERY ), $container );

            if($container != null && !empty($container) && array_key_exists('v', $container)){
                $videoId = $container['v'];

                return "http://img.youtube.com/vi/" . $videoId . "/hqdefault.jpg";
            }else{
                return asset('site/img/main-news/main-news-1.jpg');
            }
        }else{
            return asset('site/img/main-news/main-news-1.jpg');
        }
    }

    public function headerSocialMedia()
    {
        return $this->socialMedia();
    }

    public function footerSocialMedia()
    {
        return $this->socialMedia();
    }
}
