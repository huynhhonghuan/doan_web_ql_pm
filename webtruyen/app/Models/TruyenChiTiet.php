<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truyen;

class TruyenChiTiet extends Model
{
    use HasFactory;
    protected $table ='truyen_chitiet';

    protected $fillable=[
        'truyen_id',
        'hinhanh',
        'chuong',
    ];

    public function Truyen()
    {
        return $this->belongsTo(Truyen::class,'truyen_id','id');
    }
}
