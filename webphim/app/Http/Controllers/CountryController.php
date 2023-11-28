<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function create()
    {
        $title = 'Thêm quốc gia phim mới';
        return view('admin.country.add',compact('title'));
    }

    public function postcreate(Request $request)
    {
        try{
            $country = new Country();
            $country->title = $request->input('title');
            $country->slug = Str::slug($request->input('title'), '-');
            $country->description = $request->input('description');
            $country->status = $request->input('status');
            //$menu->slug = Str::slug($request->input('name'),'-');

            $country->save();
            Session::flash('success','Tạo Quốc gia thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Nhập lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Quốc Gia phim';
        $countryList = Country::orderby('id','ASC')->get();
        return view('admin.country.list',compact('title','countryList'));
    }

    public function delete($id)
    {
        try{
            $country = Country::find($id);
            $country->delete();

            Session::flash('success','Xóa Quốc Gia thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Xóa lỗi. Vui lòng kiểm tra lại');
        }

        return redirect()->route('admin.country.list');
    }

    public function edit(Request $request, $id)
    {
        try{
            $countryEdit = Country::find($id);
            $request->session()->put('id',$id);
            $title = 'Chỉnh sửa Quốc Gia ' . $countryEdit->title;
            return view('admin.country.edit', compact('title','countryEdit'));
        }catch(Exception $e)
        {
            Session::flash('error','Quốc Gia không tồn tại');
            return redirect()->route('admin.country.list');
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
            $country = Country::find($id);
            $country->title = $request->input('title');
            $country->slug = Str::slug($request->input('title'), '-');
            $country->description = $request->input('description');
            $country->status = $request->input('status');
            $country->save();

            Session::flash('success','Cập nhật Quốc Gia thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('admin.country.list');
    }
}
