<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lyric extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
