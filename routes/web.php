<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [NotesController::class, 'index']);
Route::get('notes/view/{id}', [NotesController::class, 'show']);
Route::get('notes/edit/{id}', function(Request $request, $id){
    $editable = true;
    $note = \App\Models\Note::findOrFail($id);
    $tags = findHTMLTags($note->description);
    $categories = \App\Models\Category::all();

    return view('notes.show', ["editable" => $editable, 'note' => $note, 'tags' => $tags, 'categories' => $categories]);
});
Route::post('notes/save', [NotesController::class, 'store']);
Route::get('notes/add', [NotesController::class, 'create']);
Route::post('notes/delete/{id}', [NotesController::class, 'destroy']);
Route::get('filter/author/{id}', [NotesController::class, 'filterByAuthor']);
Route::get('filter/date/{date}', [NotesController::class, 'filterByDate']);