<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TruyenChiTietRequest;
use App\Models\Truyen;
use App\Models\TruyenChiTiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TruyenChiTietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách chi tiết truyện';
        $danhsach = TruyenChiTiet::orderby('id', 'ASC')->get();
        return view('admin.truyenchitiet.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới chi tiết truyện';
        $truyen = Truyen::all();
        return view('admin.truyenchitiet.create', compact('title', 'truyen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TruyenChiTietRequest $request)
    {
        if ($request->validated()) {
            //lấy tên thư mục
            $slug = Truyen::where('id', $request->truyen_id)->first()->slug;
            $file_name = '';
            //dd($request->hasFile('hinhanh'));
            if ($file = $request->file('hinhanh')) {

                //Tạo thư mục con nếu chưa có
                $thumuc = 'chuong-' . $request->chuong;

                if (File::isDirectory($thumuc)) {
                    File::makeDirectory(public_path('image\\truyen\\' . $slug . '\\' . $thumuc), true);
                }

                //Xử lý hình ảnh lưu theo thời gian thực để k trị trùng
                $ext = $request->file('hinhanh')->extension();
                $file_name = time() . '-' . 'truyen.' . $ext;
                $file->move('image/truyen/' . $slug . '/chuong-' . $request->chuong, $file_name);
            }

            TruyenChiTiet::create($request->validated() + ['hinhanh' => $file_name]);
        }
        return redirect()->route('admin.truyenchitiet.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TruyenChiTiet $truyenChiTiet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TruyenChiTiet $truyenchitiet)
    {
        $title = 'Sửa mới chi tiết truyện';
        $truyen = Truyen::all();
        return view('admin.truyenchitiet.edit', compact('title', 'truyen', 'truyenchitiet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TruyenChiTietRequest $request, TruyenChiTiet $truyenchitiet)
    {
        if ($request->validated()) {
            //lấy tên thư mục
            $slug = Truyen::where('id', $request->truyen_id)->first()->slug;

            $file_name = $truyenchitiet->hinhanh;

            //kiểm tra nếu thư mục bằng tên viết tắt có khác với trong database và thư mục đó đã tồn tại hay không
            //nếu đúng thì sửa đổi lại tên thư mục đó

            if ($file = $request->file('hinhanh')) {

                $thumuc = 'chuong-' . $request->chuong;
                //xóa ảnh cũ nằm trong thư mục
                unlink(public_path('image/truyen/' . $slug . '/' . $thumuc . '/' . $truyenchitiet->hinhanh));

                //thêm ảnh mới vào
                $ext = $request->file('hinhanh')->extension();
                $file_name = time() . '-' . 'truyen.' . $ext; //cập nhật lại tên hình ảnh đã chỉnh
                $file->move('image/truyen/' . $slug . '/'  . $thumuc, $file_name);
            }

            $truyenchitiet->update($request->validated() + ['hinhanh' => $file_name]);
        }
        return redirect()->route('admin.truyenchitiet.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TruyenChiTiet $truyenchitiet)
    {
        //lấy tên thư mục
        $slug = Truyen::where('id', $truyenchitiet->truyen_id)->first()->slug;

        $duongdan = public_path('image/truyen/' . $slug . '/chuong-' . $truyenchitiet->chuong . '/' . $truyenchitiet->hinhanh);

        //dd($duongdan);
        //xóa thư mục hình ảnh
        if (file_exists($duongdan))
            File::delete($duongdan);

        $truyenchitiet->delete();

        return redirect()->route('admin.truyenchitiet.index');
    }
}
