<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaiKhoanRequest;
use App\Models\User;
use App\Models\User_VaiTro;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách tài khoản';
        $danhsach = User::all();
        return view('admin.taikhoan.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới tài khoản';
        $vaitro = VaiTro::all();
        return view('admin.taikhoan.create', compact('title', 'vaitro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaiKhoanRequest $request)
    {
        if ($request->validated()) {
            $username = Str::before($request->email, '@');
            $status = $request->status ?? 'actve';
            $user = User::create($request->validated() + [
                'username' => $username,
                'status' => $status,
            ]);

            User_VaiTro::create([
                'user_id' => $user->id,
                'vaitro_id' => $request->vaitro_id,
            ]);
        }

        return redirect()->route('admin.taikhoan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $taikhoan)
    {
        $title = 'Sửa tài khoản';
        $vaitro = VaiTro::all();
        return view('admin.taikhoan.edit', compact('taikhoan', 'title', 'vaitro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaiKhoanRequest $request, User $taikhoan)
    {
        if ($request->validated()) {
            $username = Str::before($request->email, '@');
            $status = $request->status ?? 'actve';

            //dd($request->change_password_checkbox);
            $taikhoan->update($request->validated() + [
                'username' => $username,
                'status' => $status,
            ]);

            if ($request->change_password_checkbox == 'on') {
                $taikhoan->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            if ($taikhoan->getVaiTro[0]->id != $request->vaitro_id) {
                $user_vaitro = User_VaiTro::where('user_id', $taikhoan->id)->first();
                $user_vaitro->vaitro_id = $request->vaitro_id;
                $user_vaitro->save();
            }
        }
        return redirect()->route('admin.taikhoan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
