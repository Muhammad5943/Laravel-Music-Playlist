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

    public function albums()
    {
        return $this->hasMany(Album::class);
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
