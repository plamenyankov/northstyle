<?php

    return [
		'base_path' => realpath(base_path('resources/themes')),
		'base_url' => 'themes',
		'theme' => [
			'active' => 'default'
		],
        'templates' => [
            'page' => MMA\Templates\PageTemplate::class,
        ]
    ];