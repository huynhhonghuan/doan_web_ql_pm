<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function create()
    {
        $title = 'Thêm thể loại mới';
        return view('admin.genre.add',compact('title'));
    }

    public function postcreate(Request $request)
    {
        try{
            $genre = new Genre();
            $genre->title = $request->input('title');
            $genre->slug = Str::slug($request->input('title'), '-');
            $genre->description = $request->input('description');
            $genre->status = $request->input('status');
            //$menu->slug = Str::slug($request->input('name'),'-');

            $genre->save();
            Session::flash('success','Tạo Thể loại thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Nhập lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Thể Loại';
        $genreList = Genre::orderby('id','ASC')->get();
        return view('admin.genre.list',compact('title','genreList'));
    }

    public function delete($id)
    {
        try{
            $genre = Genre::find($id);
            $genre->delete();

            Session::flash('success','Xóa Thể Loại thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Xóa lỗi. Vui lòng kiểm tra lại');
        }

        return redirect()->route('admin.genre.list');
    }

    public function edit(Request $request, $id)
    {
        try{
            $genreEdit = Genre::find($id);
            $request->session()->put('id',$id);
            $title = 'Chỉnh sửa Thể Loại ' . $genreEdit->title;
            return view('admin.genre.edit', compact('title','genreEdit'));
        }catch(Exception $e)
        {
            Session::flash('error','Thể loại không tồn tại');
            return redirect()->route('admin.genre.list');
        }
    }

    public function postedit(Request $request)
    {

        // $request->validate([
        //     'title' => 'required'
        // ],[
        //     'title.required' => 'Vui lòng nhập tên Danh Mục',
        // ]);

        try{
            $id=session('id');
            $genre = Genre::find($id);
            $genre->title = $request->input('title');
            $genre->slug = Str::slug($request->input('title'), '-');
            $genre->description = $request->input('description');
            $genre->status = $request->input('status');
            $genre->save();

            Session::flash('success','Cập nhật Thể Loại thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('admin.genre.list');
    }
}
