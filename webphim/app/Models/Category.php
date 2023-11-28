<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';

    public function Movie()
    {
        return $this->hasMany(Movie::class)->orderBy('id','DESC');
    }
}
