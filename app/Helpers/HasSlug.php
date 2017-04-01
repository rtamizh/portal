<?php

namespace App\Helpers;

trait HasSlug
{
    public static function findBySlug(string $slug): self
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    public function generateUniqueSlug(string $value, int $ignoreId = null): string
    {
        $slug = $originalSlug = str_slug($value);
        $counter = 0;

        while ($this->slugExists($slug, $ignoreId)) {
            $counter++;
            $slug = $originalSlug.'-'.$counter;
        }

        return $slug;
    }

    private function slugExists(string $slug, int $ignoreId = null): bool
    {
        $query = $this->where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->count();
    }
}
