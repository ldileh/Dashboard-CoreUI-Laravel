<?php

namespace App\Helpers;

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
                'iconUrl' => ''
            ],
            [
                'name' => 'Youtube',
                'url' => url('#'),
                'icon' => 'fa fa-youtube-play',
                'iconUrl' => ''
            ],
            [
                'name' => 'Twitter',
                'url' => url('#'),
                'icon' => 'fa fa-twitter',
                'iconUrl' => ''
            ],
            [
                'name' => 'Linkedin',
                'url' => url('#'),
                'icon' => 'fa fa-linkedin',
                'iconUrl' => ''
            ],
            [
                'name' => 'Skype',
                'url' => url('#'),
                'icon' => 'fa fa-skype',
                'iconUrl' => ''
            ],
            [
                'name' => 'Pinterest',
                'url' => url('#'),
                'icon' => 'fa fa-pinterest-square',
                'iconUrl' => ''
            ],
        ];
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
