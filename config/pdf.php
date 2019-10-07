<?php

return [
	'format'           => 'A4', // See https://mpdf.github.io/paging/page-size-orientation.html
	'author'           => 'John Doe',
	'subject'          => 'This Document will explain the whole universe.',
	'keywords'         => 'PDF, Laravel, Package, Peace', // Separate values with comma
	'creator'          => 'Laravel Pdf',
	'display_mode'     => 'fullpage',
	// ...
	'font_path' => base_path('/public/assets/fonts/'),
	'font_data' => [
		// 'examplefont' => [
		// 	'R'  => 'ExampleFont-Regular.ttf',    // regular font
		// 	'B'  => 'ExampleFont-Bold.ttf',       // optional: bold font
		// 	'I'  => 'ExampleFont-Italic.ttf',     // optional: italic font
		// 	'BI' => 'ExampleFont-Bold-Italic.ttf' // optional: bold-italic font
		// 	//'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
		// 	//'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		// ],
		'bangla' => [
			'R'  => 'SolaimanLipi.ttf', // regular font
			'B'  => 'SolaimanLipi.ttf', // optional: bold font
			'I'  => 'SolaimanLipi.ttf', // optional: italic font
			'BI' => 'SolaimanLipi.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,   
			'useKashida' => 75, 
		]
		// ...add as many as you want.
	]
	// ...
];