<?php

declare(strict_types=1);

use App\Controller\Index;
use Slim\App;

return static function (App $app): void {
    $app->get('/', Index::class);
};
