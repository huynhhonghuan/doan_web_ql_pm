<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\TheLoaiExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TheLoaiRequest;
use App\Imports\Admin\TheLoaiImport;
use App\Models\TheLoai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $title = 'Thêm mới Thể Loại';
        return view('admin.TheLoai.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TheLoaiRequest $request)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->tentheloai, '-');
            TheLoai::create($request->validated() + ['slug' => $slug]);
        }
        return redirect()->route('admin.theloai.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TheLoai $theloai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TheLoai $theloai)
    {
        //dd($tacgium);
        $title = 'Chỉnh sửa Thể Loại';
        return view('admin.theloai.edit', compact('theloai', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TheLoaiRequest $request, TheLoai $theloai)
    {
        // $request->validate([
        //     'tentheloai' => 'required|string',
        // ]);
        //dd($tacgium);
        if ($request->validated()) {
            $slug = Str::slug($request->tentheloai, '-');
            $theloai->update($request->validated() + ['slug' => $slug]);
        }

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
    public function postNhap(Request $request)
    {
        Excel::import(new TheLoaiImport, $request->file('file_excel'));
        return redirect()->route('admin.theloai.index');
    }

    public function getXuat()
    {
        return Excel::download(new TheLoaiExport, 'the-loai.xlsx');
    }
}
