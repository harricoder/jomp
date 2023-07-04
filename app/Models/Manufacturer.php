<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Manufacturer extends Model
{
    use HasFactory;
    use HasSlug;
    use HasUuids;

    /**
     * @var string[] Mass assignment fields (aka forms).
     */
    protected $fillable = [
        'name',
        'url',
        'description',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the plugin list.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
