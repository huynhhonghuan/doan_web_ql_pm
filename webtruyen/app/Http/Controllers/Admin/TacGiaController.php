<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TacGia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\TacGiaRequest;

class TacGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách Tác Giả';
        $danhsach = TacGia::orderby('id', 'ASC')->get();
        return view('admin.tacgia.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới tác giả';
        return view('admin.tacgia.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tentacgia' => 'required|string',
        ]);

        $slug = Str::slug($request->tentacgia, '-');
        TacGia::create([
            'tentacgia' => $request->tentacgia,
            'slug' => $slug,
            'mota' => $request->mota,
            'khoa' => $request->khoa,
        ]);

        return redirect()->route('admin.tacgia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TacGia $tacGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TacGia $tacgium)
    {
        $title = 'Chỉnh sửa tác giả';
        $tacgia = $tacgium;
        return view('admin.tacgia.edit', compact('tacgia', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TacGia $tacgium)
    {
        $request->validate([
            'tentacgia' => 'required|string',
        ]);
        //dd($tacgium);
        $slug = Str::slug($request->tentacgia, '-');
        $tacgium->update([
            'tentacgia' => $request->tentacgia,
            'slug' => $slug,
            'mota' => $request->mota,
            'khoa' => $request->khoa,
        ]);

        return redirect()->route('admin.tacgia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TacGia $tacgium)
    {
        $tacgium->delete();
        return redirect()->route('admin.tacgia.index');
    }
}
