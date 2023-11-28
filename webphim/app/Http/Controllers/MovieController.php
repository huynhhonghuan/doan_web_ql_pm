<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function create()
    {
        $title = 'Thêm phim mới';
        $category = Category::all();
        $genre = Genre::all();
        $country = Country::all();
        return view('admin.movie.add',compact('title','category','genre','country'));
    }

    public function postcreate(Request $request)
    {
        $file = $request->image;
        $dieukien=0;
        try{
            $movie = new Movie();
            $movie->title = $request->input('title');
            $movie->slug = Str::slug($request->input('title'), '-');
            $movie->description = $request->input('description');
            $movie->status = $request->input('status');
            $movie->category_id = $request->input('category_id');
            $movie->genre_id = $request->input('genre_id');
            $movie->country_id = $request->input('country_id');

            $ext=$request->image->extension();
            $file_name=time().'-'.'movie.'.$ext;

            $request->merge(['image/movie'=>$file_name]);
            $movie->image = $file_name;
            $movie->save();

            $dieukien=1;
            Session::flash('success','Thêm Phim thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Nhập lỗi. Vui lòng kiểm tra lại');
            $dieukien=0;
        }
        if($dieukien==1)
        {
            $file->move(public_path('image/movie'), $file_name);
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Phim';
        $movieList = Movie::orderby('id','ASC')->get();
        return view('admin.movie.list',compact('title','movieList'));
    }

    public function delete($id)
    {
        try{
            $movie = Movie::find($id);
            $Path = 'image/movie/'.$movie->image;
            if(file_exists($Path))
            {
                unlink($Path);
            }
            $movie->delete();

            Session::flash('success','Xóa Phim thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Xóa lỗi. Vui lòng kiểm tra lại');
        }

        return redirect()->route('admin.movie.list');
    }

    public function edit(Request $request, $id)
    {
        try{
            $movieEdit = Movie::find($id);
            $request->session()->put('id',$id);
            $title = 'Chỉnh sửa Phim ' . $movieEdit->title;
            $category = Category::all();
            $genre = Genre::all();
            $country = Country::all();
            return view('admin.movie.edit', compact('title','movieEdit','category','genre','country'));
        }catch(Exception $e)
        {
            Session::flash('error','Phim không tồn tại');
            return redirect()->route('admin.movie.list');
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
            $movie = Movie::find($id);
            $img = $request->image;
            if($img)
            {
                $Path = 'image/movie/'.$movie->image;
                if(file_exists($Path))
                {
                    unlink($Path);
                }

                $movie->title = $request->input('title');
                $movie->slug = Str::slug($request->input('title'), '-');
                $movie->description = $request->input('description');
                $movie->status = $request->input('status');
                $movie->category_id = $request->input('category_id');
                $movie->genre_id = $request->input('genre_id');
                $movie->country_id = $request->input('country_id');

                $ext=$request->image->extension();
                $file_name=time().'-'.'movie.'.$ext;
                $img->move(public_path('image/movie'), $file_name);

                $request->merge(['image/movie'=>$file_name]);
                $movie->image = $file_name;
            }
            else
            {
                $movie->title = $request->input('title');
                $movie->slug = Str::slug($request->input('title'), '-');
                $movie->description = $request->input('description');
                $movie->status = $request->input('status');
                $movie->category_id = $request->input('category_id');
                $movie->genre_id = $request->input('genre_id');
                $movie->country_id = $request->input('country_id');
            }
            $movie->save();
            Session::flash('success','Cập nhật Phim thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('admin.movie.list');
    }
}
