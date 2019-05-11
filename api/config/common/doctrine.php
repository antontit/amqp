<?php

use Psr\Container\ContainerInterface;
use Api\Infrastructure\Doctrine\Type;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL\Types\Type as DoctrineType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

return [
    EntityManagerInterface::class => function (ContainerInterface $container) {
        $params = $container['config']['doctrine'];
        $config = Setup::createAnnotationMetadataConfiguration(
            $params['metadata_dirs'],
            $params['dev_mode'],
            $params['cache_dir'],
            new FilesystemCache(
                $params['cache_dir']
            ),
            false
        );

        foreach ($params['types'] as $type => $class) {
            if (!DoctrineType::hasType($type)) {
                DoctrineType::addType($type, $class);
            }
        }

        return EntityManager::create(
            $params['connection'],
            $config
        );
    },

    'config' => [
        'doctrine' => [
            'dev_mode' => false,
            'cache_dir' => 'var/cache/doctrine',
            'metadata_dirs' => [
                'src/Model/User/Entity',
                'src/Model/OAuth/Entity',
                'src/Model/Video/Entity',
            ],
            'connection' => [
                'url' => getenv('API_DB_URL'),
            ],
            'types' => [
                Type\User\UserIdType::NAME => Type\User\UserIdType::class,
                Type\User\EmailType::NAME => Type\User\EmailType::class,
                Type\OAuth\ClientType::NAME => Type\OAuth\ClientType::class,
                Type\OAuth\ScopesType::NAME => Type\OAuth\ScopesType::class,
                Type\Video\AuthorIdType::NAME => Type\Video\AuthorIdType::class,
                Type\Video\VideoIdType::NAME => Type\Video\VideoIdType::class,
            ]
        ],
    ],
];