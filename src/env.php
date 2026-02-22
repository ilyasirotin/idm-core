<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

function env(string $name, ?string $default = null): string
{
    $value = getenv($name);

    if ($value !== false) {
        return $value;
    }

    if ($default !== null) {
        return $default;
    }

    $msg = sprintf("Undefined environment variable: %s", $name);
    throw new RuntimeException($msg);
}
