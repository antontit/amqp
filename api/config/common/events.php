<?php

declare(strict_types=1);


use Api\Infrastructure\Model\EventDispatcher\SyncEventDispatcher;
use Api\Infrastructure\Model\EventDispatcher\Listener;
use Psr\Container\ContainerInterface;


return [
    Api\Model\EventDispatcher::class => function (ContainerInterface $container) {
        return new SyncEventDispatcher(
            $container,
            [
                \Api\Model\User\Entity\User\Event\UserCreated::class => [
                    Listener\User\CreatedListener::class,
                ],
                \Api\Model\Video\Entity\Video\Event\VideoCreated::class => [
                    Listener\Video\VideoCreatedListener::class,
                ]
            ]
        );
    },

    Listener\User\CreatedListener::class => function (ContainerInterface $container) {
        return new Listener\User\CreatedListener(
            $container->get(Swift_Mailer::class),
            $container->get('config')['mailer']['from']
        );
    },

    Listener\Video\VideoCreatedListener::class => function (ContainerInterface $container) {
        return new Listener\Video\VideoCreatedListener(
            $container->get(Kafka\Producer::class)
        );
    }
];