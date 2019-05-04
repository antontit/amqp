<?php

declare(strict_types=1);

use Slim\App;
use Api\Http\Action\HomeAction;
use Api\Http\Action\Auth\SignUp\RequestAction;
use Api\Http\Action\Auth\SignUp\ConfirmAction;
use League\OAuth2\Server\Middleware\ResourceServerMiddleware;


return function (App $app, \Psr\Container\ContainerInterface $container) {

    $app->get('/', HomeAction::class . ":handle");

    $app->post('/auth/signup', RequestAction::class . ":handle");
    $app->post('/auth/signup/confirm', ConfirmAction::class . ':handle');

    $app->post('/oauth/auth', \Api\Http\Action\Auth\OAuthAction::class . ':handle');

    $auth = $container->get(ResourceServerMiddleware::class);

    $app->group('/profile', function () {
        $this->get('', \Api\Http\Action\Profile\ShowAction::class . ':handle');
    })->add($auth);
};
