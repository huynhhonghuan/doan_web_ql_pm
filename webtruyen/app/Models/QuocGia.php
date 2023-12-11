<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuocGia extends Model
{
    use HasFactory;
    protected $table ='quocgia';

    //Nếu một thuộc tính được gán giá trị và nó nằm trong $guarded, Laravel sẽ bỏ qua giá trị đó và không cập nhật thuộc tính trong cơ sở dữ liệu.
    //$guarded thường được sử dụng kết hợp với các phương thức tạo và cập nhật model, chẳng hạn như create và update.
    protected $guarded = ['id'];

    protected $fillable =[
        'tenquocgia',
        'slug',
        'mota',
        'khoa'
    ];

    public function Truyen()
    {
        return $this->hasMany(Truyen::class,'quocgia_id','id');
    }
}
