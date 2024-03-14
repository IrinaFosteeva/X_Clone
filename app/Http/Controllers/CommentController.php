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
        $comment->user_id = auth()->id();
        $comment->content = request()->get('content');
        $comment->save();


        return redirect()->route('ideas.show', $idea->id)->with('success1', 'Comment posted successfully');
    }

    public function destroy(Comment $comment) {
        if(auth()->id() !== $comment->user_id) {
            return back()->with('error', 'You are not authorized to delete this comment.');
        }
//        $comment = new Comment();
//        $comment::where('id', $comment_id)->firstOrFail()->delete(); OR
        //Comment::destroy($comment_id); OR
        $comment->delete();

        //$comment_id->delete();
        return redirect()->route('dashboard')->with('success1', 'Comment deleted successfully!');
    }
}
