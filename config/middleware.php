<?php

declare(strict_types=1);

use Middlewares\TrailingSlash;
use OauthServer\Http\Middleware\ClearEmptyInput;
use OauthServer\Http\Middleware\Cors;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return static function (App $app): void {
    $app->add(new ClearEmptyInput());
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->add(new TrailingSlash());
    $app->add(ErrorMiddleware::class);
    $app->add(new Cors($app));
};
