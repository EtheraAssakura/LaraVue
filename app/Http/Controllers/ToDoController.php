<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\ToDo;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $todo = ToDo::where('user_id', $user->id)->get();

        return Inertia::render('FrontEnd/Todo/Index', [
            'todo' => $todo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('FrontEnd/Todo/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'more_info' => 'required|string|max:255',
        ]);

        ToDo::create([
            'title' => $request->title,
            'more_info' => $request->more_info,
            'user_id' => auth()->id(),
        ]);

        return redirect()->to('/todo')->with('message','Tache ajoutée à la liste');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return Inertia::render('FrontEnd/Todo/Detail', [
            'todo' => $todo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToDo $todo)
    {
        return Inertia::render('FrontEnd/Todo/Update', [
            'todo' => $todo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToDo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'more_info' => 'string|max:255',
            'statut' => 'required|string'
        ]);

        $todo->update([
            'title' => $request->title,
            'more_info' => $request->more_info,
            'statut' => $request->statut,
        ]);

        return redirect()->to('/todo')->with('message','Tache mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ToDo $todo)
    {
        if ($todo->statut !== 'termine') {
            return redirect()->back()->with('message', 'Seules les tâches terminées peuvent être supprimées.');
        }

        $todo->delete();
        return redirect()->to('/todo')->with('message','Tache supprimer de la liste');
        
    }
}
