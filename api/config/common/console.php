<?php

use Api\Console\Command;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return [

    Command\Kafka\ConsumeCommand::class => function (ContainerInterface $container) {

        return new Command\Kafka\ConsumeCommand(
            $container->get(LoggerInterface::class),
            $container->get('config')['kafka']['broker_list']
        );
    },

    Command\Kafka\ProduceCommand::class => function (ContainerInterface $container) {

    return new Command\Kafka\ProduceCommand(
            $container->get(LoggerInterface::class),
            $container->get('config')['kafka']['broker_list']
        );
    },

    'config' => [
        'console' => [
            'commands' => [
                Command\Kafka\ConsumeCommand::class,
                Command\Kafka\ProduceCommand::class,
            ],
        ],
    ],
];
