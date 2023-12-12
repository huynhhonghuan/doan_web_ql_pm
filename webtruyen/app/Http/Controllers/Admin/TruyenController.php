<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuocGia;
use App\Models\TacGia;
use App\Models\TheLoai;
use App\Models\Truyen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\TruyenRequest;

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
            //dd($request->hasFile('hinhanh'));
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
            //băm tên truyện k dấu
            $slug = Str::slug($request->tentruyen, '-');

            //lấy tên hình ảnh cũ trước khi chỉnh
            $file_name = $truyen->hinhanh;

            //kiểm tra nếu thư mục bằng tên viết tắt có khác với trong database và thư mục đó đã tồn tại hay không
            //nếu đúng thì sửa đổi lại tên thư mục đó
            if ($truyen->slug != $slug && file_exists(public_path('image/truyen/' . $truyen->slug))) {
                rename(public_path('image/truyen/' . $truyen->slug), public_path('image/truyen/' . $slug));
            }
            if ($file = $request->file('hinhanh')) {
                //xóa ảnh cũ nằm trong thư mục
                unlink(public_path('image/truyen/' . $truyen->slug . '/' . $truyen->hinhanh));

                //thêm ảnh mới vào
                $ext = $request->file('hinhanh')->extension();
                $file_name = time() . '-' . 'truyen.' . $ext; //cập nhật lại tên hình ảnh đã chỉnh
                $file->move('image/truyen/' . $slug, $file_name);
            }
            //dd($request->nhomdich);
            $truyen->update($request->validated() + ['slug' => $slug, 'nhomdich' => $request->nhomdich, 'hinhanh' => $file_name, 'khoa' => $request->khoa]);
        }
        return redirect()->route('admin.truyen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truyen $truyen)
    {
        //xóa thư mục hình ảnh
        if (file_exists(public_path('image/truyen/' . $truyen->slug)))
            File::deleteDirectory(public_path('image/truyen/' . $truyen->slug));

        //xóa data trên db
        $truyen->delete();

        return redirect()->route('admin.truyen.index');
    }
}
