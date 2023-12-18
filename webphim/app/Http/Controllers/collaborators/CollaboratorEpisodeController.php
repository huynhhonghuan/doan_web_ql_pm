<?php

namespace App\Http\Controllers\collaborators;

use App\Models\Episode;
use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Auth;

class CollaboratorEpisodeController extends Controller
{
    public function create(Request $request, $id)
    {
        try {
            $movie = Movie::find($id);
            $episode = Episode::where('movie_id', $id)->get();
            $request->session()->put('id', $id);
            $title = 'Thêm Tập Phim cho Phim ' . $movie->title;
            return view('collaborators.episode.add', compact('title', 'movie', 'episode'));
        } catch (Exception $e) {
            Session::flash('error', 'Phim không tồn tại');
            return redirect()->route('collaborators.movie.list');
        }
    }

    public function postcreate(Request $request)
    {
        try {
            $id = session('id');
            $movie = Movie::with('category')->find($id);
            $episode = new Episode();
            $episode->movie_id = $id;
            $episode->linkphim = $request->input('linkphim');
            if($movie->category->slug == 'phim-le')
            {
                $episode->episode = 1;
            }
            else
            {
                $episode->episode = $request->input('episode');
            }
            $episode->save();

            Session::flash('success', 'Thêm Tập Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Nhập lỗi. Vui lòng kiểm tra lại');
            $dieukien = 0;
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Tập Phim';
        $episode = Episode::pluck('movie_id')->toArray();
        $movie = Movie::with('episode')->whereIn('id', $episode)->where('user_id',Auth::user()->id)->get();

        return view('collaborators.episode.list', compact('title', 'movie'));
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
            $episodeEdit = Movie::with('episode')->find($id);
            $request->session()->put('id', $id);
            $title = 'Chỉnh sửa Tập Phim cho Phim ' . $episodeEdit->title;

            $episode = Episode::pluck('movie_id')->toArray();
            $movie = Movie::with('episode')->whereIn('id', $episode)->get();

            return view('collaborators.episode.edit', compact('title', 'episodeEdit', 'movie'));
        } catch (Exception $e) {
            Session::flash('error', 'Phim không tồn tại');
            return redirect()->route('collaborators.episode.list');
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
        $movie = Movie::with('episode')->find($id);
        $episode = Episode::where('movie_id', $id)->pluck('id')->toArray();

        $arr = [];
        $arr = array_unique($episode);
        $episodeEdit = Episode::whereIn('id', $arr)->get();
        foreach ($episodeEdit as $key => $ep) {
            $ep->linkphim = $request->input('linkphim'.$key.'');
            $ep->save();
        }

        Session::flash('success', 'Cập nhật Tập Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('collaborators.episode.list');
    }
}
