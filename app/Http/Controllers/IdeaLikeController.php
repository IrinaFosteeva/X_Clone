<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea) {
        $liker = auth()->user();
        $liker->likes()->attach($idea);

        return redirect()->route('dashboard')->with('success1', 'liked successfully!');

    }

    public function unlike(Idea $idea) {
        $liker = auth()->user();
        $liker->likes()->detach($idea);
        return redirect()->route('dashboard')->with('success1', 'unliked successfully!');
    }
}
