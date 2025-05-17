<?php

declare(strict_types=1);

use OauthServer\Http\Action\Home;
use Slim\App;

return static function (App $app): void {
    $app->get('/', Home::class);
};
