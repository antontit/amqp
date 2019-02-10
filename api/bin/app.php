<?php

declare(strict_types=1);

use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Console\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

if (file_exists('.env')) {
    (new Dotenv())->load('.env');
}

/**
 * @var \Psr\Container\ContainerInterface $container
 */
$container = require 'config/container.php';

$cli = new Application('Application console');

$entityManager = $container->get(\Doctrine\ORM\EntityManagerInterface::class);

$cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');
\Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);


//$commands = $container->get('config')['console']['commands'];
//
//foreach ($commands as $command) {
//    $cli->add($container->get($command));
//}

$cli->run();
