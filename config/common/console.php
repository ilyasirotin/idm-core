<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Psr\Container\ContainerInterface;

return [
    EntityManagerProvider::class => static fn (ContainerInterface $container): EntityManagerProvider
        => new SingleManagerProvider($container->get(EntityManagerInterface::class)),

    ValidateSchemaCommand::class => static fn (ContainerInterface $container): ValidateSchemaCommand
        => new ValidateSchemaCommand($container->get(EntityManagerProvider::class)),

    'config' => [
        'console' => [
            'commands' => [
                ValidateSchemaCommand::class,

                \Doctrine\Migrations\Tools\Console\Command\ExecuteCommand::class,
                \Doctrine\Migrations\Tools\Console\Command\MigrateCommand::class,
                \Doctrine\Migrations\Tools\Console\Command\LatestCommand::class,
                \Doctrine\Migrations\Tools\Console\Command\ListCommand::class,
                \Doctrine\Migrations\Tools\Console\Command\StatusCommand::class,
                \Doctrine\Migrations\Tools\Console\Command\UpToDateCommand::class,
            ],
        ],
    ],
];
