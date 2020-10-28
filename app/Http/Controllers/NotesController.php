<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::paginate(15);

        return view('notes.index', ['notes' => $notes]);
    }

    public function filterByAuthor($filter) {
        $filter = ($filter === '0')? null: $filter;

        $notes = Note::where('author', $filter)->paginate(15);
        return view('notes.index', ['notes' => $notes]);
    }

    public function filterByDate($filter) {

        $filter = \Carbon\Carbon::createFromFormat('d-m-Y', $filter)->format('Y-m-d');
        $notes = Note::where('created_at', 'like' ,$filter."%")->paginate(15);
        return view('notes.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('notes.show', ['create' => true, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = null;

        if(isset($request->saveNote)){
            $note = new Note;
            $note->author = $request->author;
        }else{
            $note = Note::findOrFail($request->id);
        }
        
        $note->title = $request->title;
        $note->category = $request->category;
        $note->description = $request->description;

        if($note->save())
            return redirect('/')->with('success', "Se ha guardado correctamente la nota");
        else
            return back()->with("danger", "No se ha podido guardar la nota");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::findOrFail($id);


        return view('notes.show', ['note' => $note]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        if($note->delete()){
            return "Se eliminó correctamente la nota.";
        }else{
            return "Ocurrió un problema con la eliminación de la nota";
        }
    }
}
