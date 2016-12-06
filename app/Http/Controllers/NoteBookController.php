<?php

namespace App\Http\Controllers;

use App\NoteBook;
use Illuminate\Http\Request;
use App\Http\Requests\NoteBookFormRequest;
class NoteBookController extends Controller
{
    /**
     * Displays NoteBookIndexComponent Vue component,
     * which, in turn, utilizes indexNotebooks (Request $request).
     *
     * @return Illuminate\Http\Response
     */
    public function home ()
    {
        return view('notebooks.home');
    }

    /**
     * Returns all notebooks that belong to a User as JSON.
     * Used by NoteBookIndexComponent Vue component.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function indexNotebooks(Request $request)
    {
        $notebooks = $request->user()->notebooks()->orderBy('created_at', 'asc')->get();

        return response()->json($notebooks, 200);
    }

    /**
     * Returns all notes, belonging to a Notebook as JSON.
     * Used by NoteBookShowComponent Vue component.
     *
     * @return Illuminate\Http\Response
     */
    public function indexNotebook(NoteBook $notebook)
    {
        $this->authorize('show', $notebook);

        $notes = $notebook->notes()->orderBy('created_at', 'asc')->get();

        return response()->json($notes, 200);
    }

    /**
     * Creates a new Notebook and returns the uiq for the new Notebook and a status code.
     * Used by NoteBookIndexComponent Vue component.
     *
     * @param  App\Http\Requests\NoteBookFormRequest $request
     * @return Illuminate\Http\Response
     */
    public function create(NoteBookFormRequest $request)
    {
        $uid = uniqid(true);

        $request->user()->notebooks()->create([
            'uid' => $uid,
            'title' => $request->title,
        ]);

        return response()->json($uid, 200);
    }

    /**
     * Displays NoteBookShowComponent Vue component,
     * which in turn utilizes indexNotebook (Notebook $notebook).
     *
     * @param  App\NoteBook $notebook
     * @return Illuminate\Http\Response
     */
    public function show(NoteBook $notebook)
    {
        $this->authorize('show', $notebook);

        return view('notebook.show', [
            'notebook' => $notebook,
        ]);
    }

    /**
     * Displays form to edit a Notebook.
     *
     * @param  App\NoteBook $notebook
     * @return Illuminate\Http\Response
     */
    public function edit(NoteBook $notebook)
    {
        $this->authorize('edit', $notebook);

        return view('notebook.edit', [
            'notebook' => $notebook,
        ]);
    }

    /**
     * Updates a Notebook.
     *
     * @param  App\NoteBookFormRequest $request
     * @param  App\NoteBook            $notebook
     * @return Illuminate\Http\Response
     */
    public function update(NoteBookFormRequest $request, NoteBook $notebook)
    {
        $this->authorize('update', $notebook);

        $notebook->update([
            'title' => $request->title,
        ]);

        return redirect()->route('notebooks.home');
    }

    /**
     * Deletes a Notebook.
     * Use by NoteBookIndexComponent Vue component.
     *
     * @param  App\NoteBook $notebook
     * @return Illuminate\Http\Response
     */
    public function destroy(NoteBook $notebook)
    {
        $this->authorize('delete', $notebook);

        $notebook->delete();

        return response()->json(null, 200);
    }

}
