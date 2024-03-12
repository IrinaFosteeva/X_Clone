<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Idea;

class CommentController extends Controller {
    public function store(Idea $idea) {
//        $validated = request()->validate([
//            'content' => 'required|min:1|max:240' // !!! textarea name="content"
//        ]);

        //dd(request()->get('content'));

        $comment = new Comment();
        $comment->idea_id = $idea->id;
        $comment->content = request()->get('content');
        $comment->save();


        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment posted successfully');
    }
}
