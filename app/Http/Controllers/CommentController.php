<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Idea;

class CommentController extends Controller {

    public function store(Idea $idea, CreateCommentRequest $request) {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['idea_id'] = $idea->id;

        Comment::create($validated);

// the same ----->       $comment = new Comment();
//        $comment->idea_id = $idea->id;
//        $comment->user_id = auth()->id();
//        $comment->content = request()->get('content');
//        $comment->save();


        return redirect()->route('ideas.show', $idea->id)->with('success1', 'Comment posted successfully');
    }

    public function destroy(Idea $idea, Comment $comment) {
        $this->authorize('delete', $comment);
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
