<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table='episodes';

    public function Movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }
}
