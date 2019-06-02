<?php

declare(strict_types=1);

use Slim\App;
use Api\Http\Action;
use League\OAuth2\Server\Middleware\ResourceServerMiddleware;


return function (App $app, \Psr\Container\ContainerInterface $container) {

    $app->get('/', Action\HomeAction::class . ":handle");

    $app->post('/auth/signup', Action\Auth\SignUp\RequestAction::class . ":handle");
    $app->post('/auth/signup/confirm', Action\Auth\SignUp\ConfirmAction::class . ':handle');

    $app->post('/oauth/auth', Action\Auth\OAuthAction::class . ':handle');

    $auth = $container->get(ResourceServerMiddleware::class);

    $app->group('/profile', function () {
        $this->get('', Action\Profile\ShowAction::class . ':handle');
    })->add($auth);

    $app->group('/author', function () {
        $this->get('', Action\Author\ShowAction::class . ':handle');
        $this->get('/videos', Action\Author\Video\IndexAction::class . ':handle');
        $this->post('/create', Action\Author\CreateAction::class . ':handle');
        $this->post('/videos/create', Action\Author\Video\CreateAction::class . ':handle');
        $this->get('/videos/{id}', Action\Author\Video\ShowAction::class . ':handle');
    })->add($auth);
};
