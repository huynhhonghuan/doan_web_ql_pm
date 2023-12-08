<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // users - User_vaitro - vaitro
    // Từ bảng users chúng ta lấy được name vai trò từ bảng vaitro mà có 1 bảng trung gian user_vaitro
    // Sử dụng mối quan hệ belongsToMany
    public function getVaiTro(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\VaiTro', 'user_vaitro', 'user_id', 'vaitro_id');
    }

    //Kiểm tra tài khoản đăng nhập có phải là Admin
    public function Check_Admin(): bool
    {
        $user =User::with('getVaiTro')->where('id', Auth::user()->id)->get();
        $role = $user[0]->getVaiTro[0]->id;
        if($role == "ad")
            return true;
        return false;
    }

    //Kiểm tra tài khoản đăng nhập có phải là Cộng tác viên truyện
    public function Check_Congtacvientruyen(): bool
    {
        $user =User::with('getVaiTro')->where('id', Auth::user()->id)->get();
        $role = $user[0]->getVaiTro[0]->id;
        if($role == "ctvt")
            return true;
        return false;
    }

    //Kiểm tra tài khoản đăng nhập có phải là Người dùng
    public function Check_Nguoidung(): bool
    {
        $user =User::with('getVaiTro')->where('id', Auth::user()->id)->get();
        $role = $user[0]->getVaiTro[0]->id;
        if($role == "nd")
            return true;
        return false;
    }
}
