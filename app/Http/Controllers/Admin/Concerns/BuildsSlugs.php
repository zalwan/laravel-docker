<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Support\Str;

trait BuildsSlugs
{
    protected function buildSlug(?string $slug, string $fallback): string
    {
        return $slug ?: Str::slug($fallback);
    }
}
