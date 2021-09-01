<?php

namespace App\Traits;

trait UserTrait
{
    private static $className = self::class;

    /**
     * @return string
     */
    public static function handle(): string
    {
        return self::$className;
    }
}
