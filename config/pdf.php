<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
    'font_path' => base_path('resources/fonts/'),
    'font_data' => [
    'bangla' => [
        'R'  => 'SolaimanLipi_22-02-2012.ttf',    // regular font
        'B'  => 'SolaimanLipi_Bold_10-03-12.ttf',       // optional: bold font
        'I'  => 'SolaimanLipi_22-02-2012.ttf',     // optional: italic font
        'BI' => 'SolaimanLipi_Bold_10-03-12.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ]
        // ...add as many as you want.
    ]
];
