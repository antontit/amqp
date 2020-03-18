<?php

use Api\Console\Command;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Kafka\Producer;
use PhpAmqpLib\Connection\AMQPStreamConnection;


return [

    /**
     * Kafka
     */

    Command\Kafka\ConsumeCommand::class => function (ContainerInterface $container) {

        return new Command\Kafka\ConsumeCommand(
            $container->get(LoggerInterface::class),
            $container->get('config')['kafka']['broker_list']
        );
    },

    Command\Kafka\ProduceCommand::class => function (ContainerInterface $container) {
        return new Command\Kafka\ProduceCommand($container->get(Producer::class));
    },

    /**
     * AMQP
     */

    Command\Amqp\ProduceCommand::class => function (ContainerInterface $container) {
        return new Command\Amqp\ProduceCommand(
            $container->get(AMQPStreamConnection::class)
        );
    },

    Command\Amqp\ConsumeCommand::class => function (ContainerInterface $container) {
        return new Command\Amqp\ConsumeCommand(
            $container->get(AMQPStreamConnection::class)
        );
    },

    'config' => [
        'console' => [
            'commands' => [
                Command\Kafka\ConsumeCommand::class,
                Command\Kafka\ProduceCommand::class,

                Command\Amqp\ConsumeCommand::class,
                Command\Amqp\ProduceCommand::class,
            ],
        ],
    ],
];
