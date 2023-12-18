<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home()
    {
        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->get();
        $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();
        $category = Category::orderby('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'ASC')->get();
        $country = Country::orderby('id', 'ASC')->get();
        $category_home = Category::with('movie')->orderby('id', 'DESC')->where('status', 1)->get();
        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'movie_hot', 'movie_trailersidebar'));
    }
    public function category($slug)
    {
        $category = Category::orderby('id', 'ASC')->get();
        $genre = Genre::orderby('id', 'ASC')->get();
        $country = Country::orderby('id', 'ASC')->get();
        $cate_slug = Category::where('slug', $slug)->first();
        $movie = Movie::where('category_id', $cate_slug->id)->paginate(8);
        $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'movie_trailersidebar'));
    }
    public function genre($slug)
    {
        $category = Category::orderby('id', 'ASC')->get();
        $genre = Genre::orderby('id', 'ASC')->get();
        $country = Country::orderby('id', 'ASC')->get();
        $genre_slug = Genre::where('slug', $slug)->first();
        $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();
        //nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $gen) {
            $many_genre[] = $gen->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->paginate(40);
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'movie_trailersidebar'));
    }
    public function country($slug)
    {
        $category = Category::orderby('id', 'ASC')->get();
        $genre = Genre::orderby('id', 'ASC')->get();
        $country = Country::orderby('id', 'ASC')->get();
        $country_slug = Country::where('slug', $slug)->first();
        $movie = Movie::with('category', 'movie_genre', 'country')->where('country_id', $country_slug->id)->paginate(8);
        $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'movie_trailersidebar'));
    }
    public function movie($slug)
    {
        $category = Category::orderby('id', 'ASC')->get();
        $genre = Genre::orderby('id', 'ASC')->get();
        $country = Country::orderby('id', 'ASC')->get();
        $movie = Movie::with('category', 'movie_genre', 'country')->where('slug', $slug)->where('status',1)->first();

        $many_genre = [];
        $movieGenreIds = Movie_Genre::with('category', 'movie_genre', 'country')->where('movie_id', $movie->id)->pluck('genre_id')->toArray();

        if (!empty($movieGenreIds)) {
            $relatedMovieIds = Movie_Genre::whereIn('genre_id', $movieGenreIds)
                ->where('movie_id', '!=', $movie->id)
                ->pluck('movie_id')
                ->toArray();

            $many_genre = array_unique($relatedMovieIds);
        } else {
            $many_genre = [];
        }
        $movie_related = Movie::with('category', 'movie_genre', 'country')->whereIn('id', $many_genre)->orWhere('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();

        $episode = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','DESC')->take(3)->get();

        $episode_first = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();

        $episode_cur_list = Episode::with('movie')->where('movie_id',$movie->id)->get();
        $episode_cur_list_count = $episode_cur_list->count();

        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'movie_related','movie_trailersidebar','episode','episode_first','episode_cur_list_count'));
    }
    public function tag($tag)
    {
        $category = Category::orderby('id', 'ASC')->get();
        $genre = Genre::orderby('id', 'ASC')->get();
        $country = Country::orderby('id', 'ASC')->get();
        $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();

        $tag = $tag;
        $movie = Movie::where('tags', 'LIKE', '%' . $tag . '%')->paginate(40);
        return view('pages.tag', compact('category', 'genre', 'country', 'movie', 'tag', 'movie_trailersidebar'));
    }
    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderby('id', 'ASC')->get();
            $genre = Genre::orderby('id', 'ASC')->get();
            $country = Country::orderby('id', 'ASC')->get();

            $movie = Movie::where('title', 'LIKE', '%' . $search . '%')->paginate(40);

            $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();

            return view('pages.search', compact('category', 'genre', 'country', 'search', 'movie', 'movie_trailersidebar'));
        } else {
            return redirect()->to('/');
        }
    }

    public function watch($slug, $tap)
    {


        $category = Category::orderby('id', 'ASC')->get();
        $genre = Genre::orderby('id', 'ASC')->get();
        $country = Country::orderby('id', 'ASC')->get();
        $movie = Movie::with('category', 'movie_genre', 'country','episode')->where('slug', $slug)->where('status', 1)->first();
        $movie_trailersidebar = Movie::where('resolution', 2)->where('status', 1)->take(15)->get();
        if(isset($tap))
        {
            $tapphim=$tap;
            $tapphim = substr($tapphim,4,1);
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        }
        else
        {
            $tapphim = 1;
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        }

        return view('pages.watch', compact('category', 'genre', 'country', 'movie','movie_trailersidebar','episode','tapphim'));
    }
    public function episode()
    {
        return view('pages.episode');
    }
}
