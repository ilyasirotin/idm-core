<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use function OauthServer\env;

$appEnv = env('APP_ENV', 'prod');

$paths = [
    __DIR__ . '/common/*.php',
    sprintf('%s/%s/*.php', __DIR__, $appEnv),
];

$aggregator = new ConfigAggregator(array_map(function ($path) {
    return new PhpFileProvider($path);
}, $paths));

$merged = $aggregator->getMergedConfig();

$builder = new ContainerBuilder();

$builder->addDefinitions($merged);

if ($appEnv === 'prod') {
    $builder->enableCompilation(__DIR__ . '/../var/cache/php-di');
}

return $builder->build();
