<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TacGiaRequest;
use App\Models\TacGia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $title = 'Thêm mới Tác Giả';
        return view('admin.tacgia.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TacGiaRequest $request)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->tentacgia, '-');
            TacGia::create($request->validated() + ['slug' => $slug]);
        }
        return redirect()->route('admin.tacgia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TacGia $tacgia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TacGia $tacgium)
    {
        //dd($tacgium);
        $title = 'Chỉnh sửa Tác Giả';
        $tacgia = $tacgium;
        return view('admin.tacgia.edit', compact('tacgia', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TacGiaRequest $request, TacGia $tacgium)
    {
        // $request->validate([
        //     'tentacgia' => 'required|string',
        // ]);
        //dd($tacgium);
        if ($request->validated()) {
            $slug = Str::slug($request->tentacgia, '-');
            $tacgium->update($request->validated() + ['slug' => $slug]);
        }

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
