<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use function OauthServer\env;

$paths = [
    __DIR__ . '/common/*.php',
    sprintf('%s/%s/*.php', __DIR__, env('APP_ENV') ?? 'prod'),
];

$aggregator = new ConfigAggregator(array_map(function ($path) {
    return new PhpFileProvider($path);
}, $paths));

$merged = $aggregator->getMergedConfig();

$builder = new ContainerBuilder();

$builder->addDefinitions($merged);

return $builder->build();
