<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'myBlogs', 'edit']);
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
        //$comments= Comment::where('blog_id',$blog->id)->orderBy('created_at', 'desc')->get();
        return view('theme.blog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){

            $categories= Category::get();
            return view('theme.blog.edit', compact('categories','blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $req, Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
        
        $data= $req->validated();

        if($req->hasFile('image')){

            # 0- remove the old image
            Storage::delete("public/blogs/$blog->image");
            # 1- Get Image
            $image= $req->image;
            # 2- change it's current name
            $newImageName=time() . '-' . $image->getClientOriginalName();
            # 3- move image to my project
            $image->storeAs('blogs',$newImageName, 'public');
            # 4- save new name to database
            $data['image']= $newImageName;
        }

        $blog->update($data);
        
        return back()->with('blog_status', "Blog updated successfully");
    }
    abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
            Storage::delete("public/blogs/$blog->image");
            $blog->delete();
            return back()->with('delete-status', 'Blog Deleted successfully');
        }
        abort(403);
    }
    # dISOLAY ALL USER BLOGS
    public function myBlogs(){
        $blogs= Blog::where('user_id',Auth::user()->id)->paginate(10);
        return view('theme.blog.my-blogs', compact('blogs'));
    }
}
