<?php

namespace Bsdev\Shipping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Cluster extends Model
{
    use HasFactory;
    use HasSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function shippings()
    {
        return $this->belongsToMany(Cluster::class);
    }
}
