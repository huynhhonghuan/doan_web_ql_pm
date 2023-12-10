<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruyenChiTiet extends Model
{
    use HasFactory;
    protected $table ='truyen_chitiet';

    public function Truyen()
    {
        return $this->belongsTo(Truyen::class);
    }
}
