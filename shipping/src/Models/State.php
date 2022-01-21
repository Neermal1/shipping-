<?php

namespace Bsdev\Shipping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'position',
    ];
    
        public function districts()
    {
        return $this->hasMany(District::class);
    }
}
