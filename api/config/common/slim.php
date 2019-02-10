<?php

use Psr\Container\ContainerInterface;

return [
    'setting' => [
        'displayErrorDetails' => (bool)getenv('API_DEBUG'),
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => true,
    ],

    'callableResolver' => function (ContainerInterface $container) {
        return new \Bnf\Slim3Psr15\CallableResolver($container);
    },
];