<?php

declare(strict_types=1);

use Slim\App;
use Api\Http\Action\HomeAction;
use Api\Http\Action\Auth\SignUp\RequestAction;
use Api\Http\Action\Auth\SignUp\ConfirmAction;

return function (App $app) {

    $app->get('/', HomeAction::class . ":handle");
    $app->post('/auth/signup', RequestAction::class . ":handle");
    $app->post('/auth/signup/confirm', ConfirmAction::class . ':handle');

};
