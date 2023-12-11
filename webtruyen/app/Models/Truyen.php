<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    protected $table ='truyen';

    public function QuocGia()
    {
        return $this->belongsTo(QuocGia::class);
    }
    public function TacGia()
    {
        return $this->belongsTo(TacGia::class);
    }
    public function TheLoai()
    {
        return $this->belongsTo(TheLoai::class);
    }
    public function TruyenChiTiet()
    {
        return $this->hasMany(TruyenChiTiet::class,'truyen_id','id');
    }
}
