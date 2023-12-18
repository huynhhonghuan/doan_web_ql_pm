<?php

namespace App\Http\Controllers\collaborators;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CollaboratorMovieController extends Controller
{
    public function create()
    {
        $title = 'Thêm phim mới';
        $category = Category::all();
        $genre = Genre::all();
        $country = Country::all();
        return view('collaborators.movie.add', compact('title', 'category', 'genre', 'country'));
    }

    public function postcreate(Request $request)
    {
        $file = $request->image;
        $data = $request->all();
        $dieukien = 0;
        try {
            $movie = new Movie();
            $movie->title = $request->input('title');
            $movie->slug = Str::slug($request->input('title'), '-');
            $movie->description = $request->input('description');
            $movie->status = $request->input('status');
            $movie->movie_hot = $request->input('movie_hot');
            $movie->resolution = $request->input('resolution');
            $movie->subtitle = $request->input('subtitle');
            $movie->time = $request->input('time');
            if ($request->input('category_id') == 1) {
                $movie->episodes = 1;
            } else {
                $movie->episodes = $request->input('episodes');
            }
            $movie->tags = $request->input('tags');
            $movie->trailer = $request->input('trailer');
            $movie->category_id = $request->input('category_id');
            $movie->year = '2000';
            $movie->view = 0;
            $movie->user_id = Auth::user()->id;
            $movie->country_id = $request->input('country_id');
            $ext = $request->image->extension();
            $file_name = time() . '-' . 'movie.' . $ext;

            $request->merge(['image/movie' => $file_name]);
            $movie->image = $file_name;
            $movie->save();

            //nhieu th loai
            $movie->Movie_Genre()->attach($data['genre']);

            $dieukien = 1;
            Session::flash('success', 'Thêm Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Nhập lỗi. Vui lòng kiểm tra lại');
            $dieukien = 0;
        }
        if ($dieukien == 1) {
            $file->move(public_path('image/movie'), $file_name);
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Phim';
        $movieList = Movie::with('category', 'movie_genre', 'country', 'user')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        // $path = public_path() . "/json/";

        // if (!is_dir($path)) {
        //     mkdir($path, 0777, true);
        // }
        // File::put($path . 'movies.json', json_encode($movieList));

        return view('collaborators.movie.list', compact('title', 'movieList'));
    }

    public function delete($id)
    {
        try {
            $movie = Movie::find($id);
            $Path = 'image/movie/' . $movie->image;
            if (file_exists($Path)) {
                unlink($Path);
            }
            $movie->delete();

            Session::flash('success', 'Xóa Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Xóa lỗi. Vui lòng kiểm tra lại');
        }

        return redirect()->route('collaborators.movie.list');
    }

    public function edit(Request $request, $id)
    {
        try {
            $movieEdit = Movie::with('movie_genre')->find($id);
            $request->session()->put('id', $id);
            $title = 'Chỉnh sửa Phim ' . $movieEdit->title;
            $category = Category::all();
            $genre = Genre::all();
            $movie_genre = $movieEdit->movie_genre;
            $country = Country::all();
            return view('collaborators.movie.edit', compact('title', 'movieEdit', 'category', 'genre', 'country', 'movie_genre'));
        } catch (Exception $e) {
            Session::flash('error', 'Phim không tồn tại');
            return redirect()->route('collaborators.movie.list');
        }
    }

    public function postedit(Request $request)
    {

        // $request->validate([
        //     'title' => 'required'
        // ],[
        //     'title.required' => 'Vui lòng nhập tên Danh Mục',
        // ]);

        $data = $request->all();
        try {
            $id = session('id');
            $movie = Movie::find($id);
            $img = $request->image;
            $movie->title = $request->input('title');
            $movie->slug = Str::slug($request->input('title'), '-');
            $movie->description = $request->input('description');
            $movie->status = $request->input('status');
            $movie->movie_hot = $request->input('movie_hot');
            $movie->resolution = $request->input('resolution');
            $movie->subtitle = $request->input('subtitle');
            $movie->time = $request->input('time');
            $movie->tags = $request->input('tags');
            $movie->trailer = $request->input('trailer');
            if ($request->input('category_id') == 1) {
                $movie->episodes = 1;
            } else {
                $movie->episodes = $request->input('episodes');
            }
            $movie->category_id = $request->input('category_id');
            $movie->country_id = $request->input('country_id');
            if ($img) {
                $Path = 'image/movie/' . $movie->image;
                if (file_exists($Path)) {
                    unlink($Path);
                }
                $ext = $request->image->extension();
                $file_name = time() . '-' . 'movie.' . $ext;
                $img->move(public_path('image/movie'), $file_name);

                $request->merge(['image/movie' => $file_name]);
                $movie->image = $file_name;
            }
            $movie->save();
            $movie->Movie_Genre()->sync($data['genre']);
            Session::flash('success', 'Cập nhật Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('collaborators.movie.list');
    }
    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_movie']);
        $movie->year = $data['year'];
        $movie->save();
    }
}
