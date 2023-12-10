<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    protected $table ='theloai';

    public function Truyen()
    {
        return $this->hasMany(Truyen::class,'theloai_id','id');
    }
}
