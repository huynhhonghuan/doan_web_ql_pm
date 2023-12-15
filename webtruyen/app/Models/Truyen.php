<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TacGia;
use App\Models\QuocGia;
use App\Models\TheLoai;
use App\Models\User;
use App\Models\TruyenChiTiet;

class Truyen extends Model
{
    use HasFactory;
    protected $table = 'truyen';

    protected $fillable = [
        'tentruyen',
        'slug',
        'mota',
        'khoa',
        'nhomdich',
        'hinhanh',
        'theloai_id',
        'tacgia_id',
        'quocgia_id',
        'user_id'
    ];

    public function QuocGia()
    {
        return $this->belongsTo(QuocGia::class, 'quocgia_id', 'id');
    }
    public function TacGia()
    {
        return $this->belongsTo(TacGia::class, 'tacgia_id', 'id');
    }
    public function TheLoai()
    {
        return $this->belongsTo(TheLoai::class, 'theloai_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function TruyenChiTiet()
    {
        return $this->hasMany(TruyenChiTiet::class, 'truyen_id', 'id');
    }
}
