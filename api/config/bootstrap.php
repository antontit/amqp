<?php

declare(strict_types=1);

return function (\Slim\Container $container) {

    $container['callableResolver'] = function ($container) {
        return new \Bnf\Slim3Psr15\CallableResolver($container);
    };

};