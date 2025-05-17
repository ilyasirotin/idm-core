<?php

declare(strict_types=1);

use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader;

return [
    TwigEnvironment::class => static function (): TwigEnvironment {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        return new TwigEnvironment($loader, ['cache' => __DIR__ . '/../../var/cache/twig']);
    },
];
