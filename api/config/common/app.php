<?php

use Api\Http\Action;
use Api\Model\User\UseCase\SignUp\Request\Handler;
use Psr\Container\ContainerInterface;

return [
    Action\HomeAction::class => function () {
        return new Action\HomeAction();
    },

    Action\Auth\SignUp\RequestAction::class => function (ContainerInterface $container) {
        return new Action\Auth\SignUp\RequestAction($container->get(Handler::class));
    },

    Action\Auth\SignUp\ConfirmAction::class => function (ContainerInterface $container) {
        return new Action\Auth\SignUp\ConfirmAction(
            $container->get(Api\Model\User\UseCase\SignUp\Confirm\Handler::class)
        );
    },
];