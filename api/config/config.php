<?php

declare(strict_types=1);

return [
	'setting' => [
        'displayErrorDetails' => (bool)getenv('API_DEBUG'),
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => true,
    ],
];