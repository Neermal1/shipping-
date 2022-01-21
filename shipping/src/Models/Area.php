<?php

namespace Bsdev\Shipping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Area extends Model
{

    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'district_id',
        'position',
        'status'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function clusters()
    {
        return $this->belongsToMany(Cluster::class);
    }
}
