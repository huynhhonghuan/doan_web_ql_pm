<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TruyenRequest;
use App\Models\QuocGia;
use App\Models\TacGia;
use App\Models\TheLoai;
use App\Models\Truyen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\File;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách truyện';
        $danhsach = Truyen::orderby('id', 'ASC')->get();
        return view('admin.truyen.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới truyện';
        $quocgia = QuocGia::all();
        $tacgia = TacGia::all();
        $theloai = TheLoai::all();
        return view('admin.truyen.create', compact('title', 'quocgia', 'tacgia', 'theloai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TruyenRequest $request)
    {

        if ($request->validated()) {

            $slug = Str::slug($request->tentruyen, '-');

            $file_name = '';
            if ($file = $request->file('hinhanh')) {
                //Tạo thư mục nếu chưa có
                if (File::isDirectory($slug)) {
                    File::makeDirectory(public_path('image/truyen/' . $slug), true);
                }
                //Xử lý hình ảnh lưu theo thời gian thực để k trị trùng
                $ext = $request->file('hinhanh')->extension();
                $file_name = time() . '-' . 'truyen.' . $ext;
                $file->move('image/truyen/' . $slug, $file_name);
            }

            Truyen::create($request->validated() + ['slug' => $slug, 'hinhanh' => $file_name, 'khoa' => $request->khoa]);
        }

        return redirect()->route('admin.truyen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Truyen $truyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Truyen $truyen)
    {
        $title = 'Chỉnh sửa truyện';
        $quocgia = QuocGia::all();
        $tacgia = TacGia::all();
        $theloai = TheLoai::all();
        return view('admin.truyen.edit', compact('truyen', 'title', 'quocgia', 'tacgia', 'theloai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TruyenRequest $request, Truyen $truyen)
    {

        if ($request->validated()) {

            $tr = Truyen::find($truyen->id)->first();
            //dd($tr);

            $slug = Str::slug($request->tentruyen, '-');

            $file_name = '';

            //dd($request->hasFile('hinhanh'));
            if ($request->hasFile('hinhanh')) {
                //Tạo thư mục nếu chưa có
                // if (File::isDirectory($slug)) {
                //     File::makeDirectory(public_path('image/truyen/' . $slug), true);
                // }
                //dd($tr);
                if (!$tr) {
                    File::copyDirectory(public_path('image/truyen/' . $tr->slug), public_path('image/truyen/' . $slug));

                    //Xử lý hình ảnh lưu theo thời gian thực để k trị trùng
                    $file = $request->file('hinhanh');
                    $ext = $request->file('hinhanh')->extension();
                    $file_name = time() . '-' . 'truyen.' . $ext;
                    $file->move('image/truyen/' . $slug, $file_name);
                }
            } else {
                $file_name = $tr->hinhanh;
            }
            //dd($file_name);
            $truyen->update($request->validated() + ['slug' => $slug, 'hinhanh' => $file_name, 'khoa' => $request->khoa]);
        }
        return redirect()->route('admin.truyen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truyen $truyen)
    {
        //
    }
}
