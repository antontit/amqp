<?php

declare(strict_types=1);

use Api\Http\Action\HomeAction;
use Api\Http\Middleware\CORSMiddleware;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$config = require 'config/config.php';

$app = new \Slim\App($config);

$container = $app->getContainer();

$container['callableResolver'] = function ($container) {
    return new \Bnf\Slim3Psr15\CallableResolver($container);
};

$app->get('/', HomeAction::class . ":handle");

$app->add(CORSMiddleware::class);

$app->run();