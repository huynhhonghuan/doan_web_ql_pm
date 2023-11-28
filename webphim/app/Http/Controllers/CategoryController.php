<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Exception;

class CategoryController extends Controller
{
    public function create()
    {
        $title = 'Thêm danh mục mới';
        return view('admin.category.add',compact('title'));
    }

    public function postcreate(Request $request)
    {
        try{
            $category = new Category();
            $category->title = $request->input('title');
            $category->slug = Str::slug($request->input('title'), '-');
            $category->description = $request->input('description');
            $category->status = $request->input('status');

            $category->save();

            Session::flash('success','Tạo Danh Mục thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Nhập lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Danh Mục';
        $categoryList = Category::orderby('id','ASC')->get();
        return view('admin.category.list',compact('title','categoryList'));
    }

    public function delete($id)
    {
        // try{
            $category = Category::find($id);
            $category->delete();

            Session::flash('success','Xóa Danh Mục thành công');
        // }catch(Exception $e)
        // {
        //     Session::flash('error','Xóa lỗi. Vui lòng kiểm tra lại');
        // }

        return redirect()->route('admin.category.list');
    }

    public function edit(Request $request, $id)
    {
        try{
            $categoryEdit = Category::find($id);
            $request->session()->put('id',$id);
            $title = 'Chỉnh sửa Danh Mục ' . $categoryEdit->title;
            return view('admin.category.edit', compact('title','categoryEdit'));
        }catch(Exception $e)
        {
            Session::flash('error','Danh Mục không tồn tại');
            return redirect()->route('admin.category.list');
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
            $category = Category::find($id);
            $category->title = $request->input('title');
            $category->slug = Str::slug($request->input('title'), '-');
            $category->description = $request->input('description');
            $category->status = $request->input('status');
            $category->save();

            Session::flash('success','Cập nhật Danh Mục thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('admin.category.list');
    }

}
