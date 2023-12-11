<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\QuocGia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\QuocGiaRequest;

class QuocGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách Quốc Gia';
        $danhsach = QuocGia::orderby('id', 'ASC')->get();
        return view('admin.quocgia.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới quốc gia';
        return view('admin.quocgia.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuocGiaRequest $request)
    {
        // $request->validate([
        //     'tenquocgia' => 'required|string',
        // ]);
        if ($request->validated()) {
            $slug = Str::slug($request->tenquocgia, '-');
            //dd($request->validated());
            QuocGia::create($request->validated() + ['slug' => $slug]);
        }
        return redirect()->route('admin.quocgia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuocGia $quocGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuocGia $quocgium)
    {
        //dd($quocgium);
        $title = 'Chỉnh sửa quốc gia';
        $quocgia = $quocgium;
        return view('admin.quocgia.edit', compact('quocgia', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuocGia $quocgium)
    {
        $request->validate([
            'tenquocgia' => 'required|string',
        ]);
        //dd($quocgium);
        $slug = Str::slug($request->tenquocgia, '-');
        $quocgium->update([
            'tenquocgia' => $request->tenquocgia,
            'slug' => $slug,
            'mota' => $request->mota,
            'khoa' => $request->khoa,
        ]);

        return redirect()->route('admin.quocgia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuocGia $quocgium)
    {
        $quocgium->delete();
        return redirect()->route('admin.quocgia.index');
    }
}
