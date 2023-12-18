<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table='movies';

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // public function Genre()
    // {
    //     return $this->belongsTo(Genre::class, 'genre_id', 'id');
    // }

    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function Movie_Genre()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id','genre_id');
    }

    public function Episode()
    {
        return $this->hasMany(Episode::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
