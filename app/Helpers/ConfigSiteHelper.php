<?php

namespace App\Helpers;

use App\Models\BusinessUnit;
use App\Models\Video;

class ConfigSiteHelper{

    public static function instance()
    {
        return new ConfigSiteHelper();
    }

    public function menus()
    {
        $businessUnits = $this->getBusinessUnitMenu();

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
                'child' => $businessUnits
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
                'name' => 'Youtube',
                'url' => 'https://www.youtube.com/user/masyarakatadat',
                'icon' => 'fa fa-youtube-play',
                'iconUrl' => '',
                'color' => '#E50017'
            ],
            [
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com/kpamanmandiri?_rdc=1&_rdr',
                'icon' => 'fa fa-facebook',
                'iconUrl' => '',
                'color' => '#056ED8'
            ],
            [
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com/rumah.aman/',
                'icon' => 'fa fa-instagram',
                'iconUrl' => '',
                'color' => '#C13584'
            ],
            [
                'name' => 'WhatsApp',
                'url' => url('#'),
                'icon' => 'fa fa-whatsapp',
                'iconUrl' => '',
                'color' => '#4AC959'
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
        if($this->isVideoYoutube($video->video_url)){
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

    public function getVideoIdYoutube($url)
    {
        if($this->isVideoYoutube($url)){
            $container = [];
            parse_str( parse_url( $url, PHP_URL_QUERY ), $container );

            if($container != null && !empty($container) && array_key_exists('v', $container)){
                return $container['v'];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function isVideoYoutube($url)
    {
        return !empty($url) && strpos($url, 'youtube.com');
    }

    public function headerSocialMedia()
    {
        return $this->socialMedia();
    }

    public function footerSocialMedia()
    {
        return $this->socialMedia();
    }

    private function getBusinessUnitMenu()
    {
        $businessUnits = BusinessUnit::whereNull('business_unit_id')->get();

        // do maping result
        return $businessUnits->map(function($item){
            if(!$item->childs->isEmpty()){
                $childs = $item->childs->map(function($child){
                    return [
                        'title' => $child->title,
                        'url' => !empty($child->url_page) ? $child->url_page : route('site.unit_usaha.detail', $child),
                        'target' => '_self'
                    ];
                });

                return [
                    'title' => $item->title,
                    'url' => url('#'),
                    'target' => '_self',
                    'child' => $childs
                ];
            }else{
                return [
                    'title' => $item->title,
                    'url' => !empty($item->url_page) ? $item->url_page : route('site.unit_usaha.detail', $item),
                    'target' => '_self',
                ];
            }
        });
    }
}
