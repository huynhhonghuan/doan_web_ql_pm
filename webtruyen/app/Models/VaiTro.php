<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    use HasFactory;
    protected $table ='vaitro';

    // protected $primaryKey = 'id';
    // protected $keyType = 'string';
    // protected $hidden = ['ghichu'];

    protected $fillable=[
        'tenviatro',
        'mota',
        'ghichu'
    ];
}
