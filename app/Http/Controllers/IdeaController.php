<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function store() {

        $validated = request()->validate([
            'content' => 'required|min:1|max:240' // !!! textarea name="idea"
        ]);
        $validated['user_id'] = auth()->id();

//                $idea = new Idea([
//            'content' => request()->get('idea', ''),
//        ]);
        //$idea->save();

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success1', 'Idea created successfully!');


    }

    public function destroy(Idea $idea) {
        $this->authorize('delete', $idea);
        $idea->delete();
        return redirect()->route('dashboard')->with('success1', 'Idea deleted successfully!');

    }

    public function show(Idea $idea) {

//        return view('ideas.show', [
//            'idea' => $idea
//        ]); OR

        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea) {
        $this->authorize('update', $idea);
        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea) {
        $this->authorize('update', $idea);
        $validated = request()->validate([
            'content' => 'required|min:1|max:240' // !!! textarea name="idea"
        ]);

//        $idea->content = request()->get('content', '');
//        $idea->save();
        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully');
    }
}

