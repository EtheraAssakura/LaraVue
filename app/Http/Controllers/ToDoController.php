<?php

namespace App\Http\Controllers;

use App\Models\ToDoItem;
use Spatie\Tags\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $todo = ToDoItem::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();

        return Inertia::render('FrontEnd/Todo/IndexTodo', [
            'todo' => $todo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('FrontEnd/Todo/CreateTodoItem');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'more_info' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
        ]);

        $todo = ToDoItem::create([
            'title' => $request->title,
            'more_info' => $request->more_info,
            'user_id' => auth()->id(),
        ]);

        if ($request->has('tags') && $request->tags) {
            
            $tag_explo = explode(',',$request->tags);

            $trimed_tag = array_map('trim', $tag_explo);

            foreach($trimed_tag as $tag){
                $tags = Tag::findOrCreate($tag);
            
                $todo->attachTag($tags);
            }
            
        }

        return redirect()->to('/todo')->with('message', 'Tache ajoutée à la liste');
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoItem $todo)
    {

        $todo->load('tags');

        return Inertia::render('FrontEnd/Todo/DetailTodoItem', [
            'todo' => $todo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToDoItem $todo)
    {
        $todo->load('tags');

        return Inertia::render('FrontEnd/Todo/UpdateTodoItem', [
            'todo' => $todo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToDoItem $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'more_info' => 'nullable|string|max:255',
            'statut' => 'required|string',
            'tag' => 'nullable|string|max:255',
        ]);

        $todo->update([
            'title' => $request->title,
            'more_info' => $request->more_info,
            'statut' => $request->statut,
        ]);

        if ($request->has('tags') && $request->tags) {
            
            $tag_explo = explode(',',$request->tags);

            $trimed_tags = array_map('trim', $tag_explo);

            $tags = array_map(fn($tag) => Tag::findOrCreate($tag), $trimed_tags);
            
            $todo->syncTags($tags);
        }

        return redirect()->to('/todo')->with('message', 'Tache mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ToDoItem $todo)
    {
        if ($todo->statut !== 'termine') {
            return redirect()->back()->with('message', 'Seules les tâches terminées peuvent être supprimées.');
        }

        $todo->delete();

        return redirect()->to('/todo')->with('message', 'Tache supprimer de la liste');

    }
}