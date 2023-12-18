<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    use HasFactory;
    protected $table='user_role';
    protected $fillable =[
        'user_id',
        'role_id'
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Role(){
        return $this->belongsTo(Role::class);
    }
}
