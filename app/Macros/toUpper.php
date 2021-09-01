<?php

namespace App\Macros;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

if (!Collection::hasMacro('toUpper')) {
    Collection::macro('toUpper', function ($locale = null) {
        return $this->map(function ($value) use ($locale) {
             //return Str::upper($value);
        });
    });
}
