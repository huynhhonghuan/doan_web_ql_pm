<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $category = Category::orderby('id','ASC')->where('status',1)->get();
        $genre = Genre::orderby('id','ASC')->get();
        $country = Country::orderby('id','ASC')->get();
        $category_home = Category::orderby('id','ASC')->where('status',1)->get();
        return view('pages.home',compact('category','genre','country','category_home'));
    }
    public function category($slug)
    {
        $category = Category::orderby('id','ASC')->get();
        $genre = Genre::orderby('id','ASC')->get();
        $country = Country::orderby('id','ASC')->get();
        $cate_slug= Category::where('slug',$slug)->first();
        return view('pages.category',compact('category','genre','country','cate_slug'));
    }
    public function genre($slug)
    {
        $category = Category::orderby('id','ASC')->get();
        $genre = Genre::orderby('id','ASC')->get();
        $country = Country::orderby('id','ASC')->get();
        $genre_slug= Genre::where('slug',$slug)->first();
        return view('pages.genre',compact('category','genre','country','genre_slug'));
    }
    public function country($slug)
    {
        $category = Category::orderby('id','ASC')->get();
        $genre = Genre::orderby('id','ASC')->get();
        $country = Country::orderby('id','ASC')->get();
        $country_slug= Country::where('slug',$slug)->first();
        return view('pages.country',compact('category','genre','country','country_slug'));
    }
    public function movie()
    {
        return view('pages.movie');
    }
    public function watch()
    {
        return view('pages.watch');
    }
    public function episode()
    {
        return view('pages.episode');
    }
}
