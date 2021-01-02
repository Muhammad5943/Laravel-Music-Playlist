<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Band extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    /* public function picture()
    {
        return asset("storage/". $this->thumbnail);
    } used when we coll it to the blade or ui using "$band->picture()" */

    public function getPictureAttribute()
    {
        return asset("storage/". $this->thumbnail);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function album()
    {
        return $this->hasOne(Album::class)->latest();
    }

    public function lyrics()
    {
        return $this->hasMany(Lyric::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
