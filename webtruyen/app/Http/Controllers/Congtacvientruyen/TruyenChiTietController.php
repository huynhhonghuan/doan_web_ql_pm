<?php

namespace App\Http\Controllers\Congtacvientruyen;

use App\Exports\Admin\TruyenChiTietExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TruyenChiTietRequest;
use App\Imports\Admin\TruyenChiTietImport;
use App\Models\Truyen;
use App\Models\TruyenChiTiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class TruyenChiTietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách chi tiết truyện';
        $danhsach = TruyenChiTiet::orderby('id', 'ASC')->get();
        return view('congtacvientruyen.truyenchitiet.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới chi tiết truyện';
        $truyen = Truyen::all();
        return view('congtacvientruyen.truyenchitiet.create', compact('title', 'truyen'));
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
        return redirect()->route('ctvt.truyenchitiet.index');
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
        return view('congtacvientruyen.truyenchitiet.edit', compact('title', 'truyen', 'truyenchitiet'));
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
        return redirect()->route('ctvt.truyenchitiet.index');
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

        return redirect()->route('ctvt.truyenchitiet.index');
    }
    public function postNhap(Request $request)
    {
        Excel::import(new TruyenChiTietImport, $request->file('file_excel'));

        if ($file = $request->file('hinhanh')) {

            //$thumuc = [];
            foreach ($file as $hinhanh) {

                //lấy thông tin truyện từ hình tên hình ảnh
                //nếu tên hình ảnh trùng với tên hình ảnh được lưu trong db thì lấy thông tin truyện đó
                $truyenchitiet = TruyenChiTiet::where('hinhanh', $hinhanh->getClientOriginalName())->first();

                $slug = $truyenchitiet->Truyen->slug;

                //nếu thông tin chuyện khác null
                if ($truyenchitiet != null) {
                    //Tạo thư mục nếu chưa có
                    //dd(!File::isDirectory(public_path('image/truyen/' . $truyen->slug)));
                    $path = public_path('image/truyen/' . $slug . '/chuong-' . $truyenchitiet->chuong);
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, true);
                    }

                    //nếu hình ảnh chưa có thì thêm ảnh đó vào thư mục
                    if (!File::exists($path . '/' . $truyenchitiet->hinhanh)) {
                        $hinhanh->move($path, $hinhanh->getClientOriginalName());
                    }
                }
            }
        }

        return redirect()->route('ctvt.truyenchitiet.index');
    }
    public function getXuat()
    {
        return Excel::download(new TruyenChiTietExport, 'truyen-chi-tiet.xlsx');
    }
    //xuất tất cả hình ảnh ra file zip
    public function getHinh()
    {
        $zip = new ZipArchive();
        $file_name = 'truyenchitiet.zip';

        //xóa thư mục truyen.zip nếu đã có trước đó
        if (file_exists(public_path('image/' . $file_name)))
            File::deleteDirectory(public_path('image/' . $file_name));

        $truyenchitiet = TruyenChiTiet::all();
        $truyen = Truyen::all();
        if ($zip->open(public_path('image/' . $file_name), ZipArchive::CREATE) === True) {

            foreach ($truyen as $tr1) {
                foreach ($truyenchitiet as $tr) {
                    $files = File::files(public_path('image/truyen/' . $tr1->slug . '/chuong-' . $tr->chuong));

                    foreach ($files as $item) {
                        $zip->addFile($item, basename($item));
                    }
                }
            }


            $zip->close();
        }
        return response()->download(public_path('image/' . $file_name));
    }
}
