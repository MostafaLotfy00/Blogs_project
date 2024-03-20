<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create']);
    }
        
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::get();
        return view('theme.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $req)
    {
        $data= $req->validated();
        # 1- Get Image
        $image= $req->image;
        # 2- change it's current name
        $newImageName=time() . '-' . $image->getClientOriginalName();
        # 3- move image to my project
        $image->storeAs('blogs',$newImageName, 'public');
        # 4- save new name to database
        $data['image']= $newImageName;
        $data['user_id']= Auth::user()->id;
        
        # Create new blog record

        Blog::create($data);

        return back()->with('blog_status', "Blog Created Successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
