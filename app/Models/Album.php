<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function band()
    {
        return $this->belongsTo(Band::class);
    }

    public function lyrics()
    {
        return $this->hasMany(Lyric::class);
    }
}
