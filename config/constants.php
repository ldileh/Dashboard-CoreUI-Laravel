<?php

return [
	'USER' => [
		'ROLE' => [
			'ADMIN' => 1,
			'MANAGEMENT' => 2,
		],
	],

    'EMAIL' => 'kpam@aman.or.id',

    'MEMBER' => [
        'STATUS' => [
            'REGISTER' => 1,
            'APPROVE' => 2,
        ]
    ],

	'AUTHREDIRECT' => '/panel',

    'DATE' => [
        'DEFAULT' => 'd/F/Y H:m:s',
        'INPUT_DATE' => 'Y-m-d',
        'DATE_SIMPLE' => 'F d, Y',
    ],

    'STORAGE' => [
        'DISK' => [
            'DEFAULT' => 'public',
            'PRIVATE' => 'local'
        ],
        'PATH' => [
            'NEWS' => 'images/news',
            'GALLERY' => 'images/gallery',
            'PRODUCT' => 'images/product',
            'MEMBER' => [
                'DEFAULT' => 'files/member',
                'KTP' => 'files/member/ktp',
                'PASS_PHOTO' => 'files/member/pass_photo'
            ],
        ]
    ],

    'FILE' => [
        'MEMBER' => [
            'KTP' => 'KTP',
            'PASS_PHOTO' => 'PASS_PHOTO'
        ]
    ]
];
