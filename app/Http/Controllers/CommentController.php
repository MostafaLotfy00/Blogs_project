<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(CreateCommentRequest $req){
        $comment= $req->validated();
        Comment::create($comment);
        return back()->with('comment_status', 'Comment created successfully');
    }
}
