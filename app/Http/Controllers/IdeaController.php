<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function store(CreateIdeaRequest $request) {

        $validated = $request->validated();
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

    public function update(Idea $idea, UpdateIdeaRequest $request) {
        $this->authorize('update', $idea);
        $validated = $request->validated();

//        $idea->content = request()->get('content', '');
//        $idea->save();
        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully');
    }
}

