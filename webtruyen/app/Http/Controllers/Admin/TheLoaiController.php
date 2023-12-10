<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\TheLoaiRequest;

class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách Thể Loại';
        $danhsach = TheLoai::orderby('id', 'ASC')->get();
        return view('admin.theloai.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới thể loại';
        return view('admin.theloai.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tentheloai' => 'required|string',
        ]);

        $slug = Str::slug($request->tentheloai, '-');
        TheLoai::create([
            'tentheloai' => $request->tentheloai,
            'slug' => $slug,
            'mota' => $request->mota,
            'khoa' => $request->khoa,
        ]);

        return redirect()->route('admin.theloai.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TheLoai $theLoai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TheLoai $theloai)
    {
        $title = 'Chỉnh sửa thể loại';
        return view('admin.theloai.edit', compact('theloai', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TheLoai $theloai)
    {
        $request->validate([
            'tentheloai' => 'required|string',
        ]);
        //dd($theLoai);
        $slug = Str::slug($request->tentheloai, '-');
        $theloai->update([
            'tentheloai' => $request->tentheloai,
            'slug' => $slug,
            'mota' => $request->mota,
            'khoa' => $request->khoa,
        ]);

        return redirect()->route('admin.theloai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TheLoai $theloai)
    {
        $theloai->delete();
        return redirect()->route('admin.theloai.index');
    }
}
