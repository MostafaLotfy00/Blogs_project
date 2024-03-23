<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class ThemeController extends Controller
{
    public function index() {
        //$blogs= Blog::orderBy('created_at', 'desc')->paginate(4);
        $blogs= Blog::latest()->paginate(4);
        $recentBlogs= Blog::latest()->take(4)->get();
        return view('theme.index',compact('blogs','recentBlogs'));
    }
    public function category($id) {
        $categoryName= Category::find($id)->name;
        $blogs= Blog::where('category_id', $id)->paginate(8);
        return view('theme.category',compact('blogs','categoryName'));
    }
    public function contact() {
        return view('theme.contact');
    }
 
    
}
