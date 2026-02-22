<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Psr\Container\ContainerInterface;

return [
    EntityManagerProvider::class => static fn (ContainerInterface $container): SingleManagerProvider
        => new SingleManagerProvider($container->get(EntityManagerInterface::class)),

    ValidateSchemaCommand::class => static fn (ContainerInterface $container): ValidateSchemaCommand
        => new ValidateSchemaCommand($container->get(EntityManagerProvider::class)),

    'config' => [
        'console' => [
            'commands' => [
                \Doctrine\Migrations\Tools\Console\Command\DiffCommand::class,
                \Doctrine\Migrations\Tools\Console\Command\GenerateCommand::class,
                \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand::class,
            ],
        ],
    ],
];
