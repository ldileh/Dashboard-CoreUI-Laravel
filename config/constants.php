<?php

return [
	'USER' => [
		'ROLE' => [
			'ADMIN' => 1,
			'MANAGEMENT' => 2,
		],
	],

    'MEMBER' => [
        'STATUS' => [
            'REGISTER' => 1,
            'APPROVE' => 2,
        ]
    ],

	'AUTHREDIRECT' => '/panel',

    'DATE' => [
        'DEFAULT' => 'd/F/Y H:m:s'
    ],

    'STORAGE' => [
        'DISK' => 'public',
        'PATH' => [
            'NEWS' => 'images/news'
        ]
    ]
];
