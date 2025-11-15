<?php

namespace App\Actions;

/**
 * @method mixed handle() Do action. (Can accept any params)
 */
abstract class BaseAction
{
    public static function run(...$arguments): mixed
    {
        $instance = app(static::class);
        return $instance->handle(...$arguments);
    }
}
