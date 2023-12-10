<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacGia extends Model
{
    use HasFactory;
    protected $table ='tacgia';

    public function Truyen()
    {
        return $this->hasMany(Truyen::class,'tacgia_id','id');
    }
}
