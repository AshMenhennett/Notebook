<?php

namespace App\Http\Controllers;

use App\NoteBook;
use Illuminate\Http\Request;
use App\Http\Requests\NoteBookFormRequest;
class NoteBookController extends Controller
{

    public function home(Request $request)
    {
        return view('notebooks.home');
    }

    /**
     * Returns all notebooks as JSON
     * @param  Request $request
     * @return JSON
     */
    public function indexNotebooks(Request $request)
    {
        $notebooks = $request->user()->notebooks()->orderBy('created_at', 'asc')->get();

        return response()->json($notebooks, 200);
    }

    /**
     * Returns all notes, given a notebook as JSON
     * @param  Request $request
     * @return JSON
     */
    public function indexNotebook(NoteBook $notebook)
    {
        $this->authorize('show', $notebook);

        $notes = $notebook->notes()->orderBy('created_at', 'asc')->get();

        return response()->json($notes, 200);
    }

    public function create(NoteBookFormRequest $request)
    {
        $uid = uniqid(true);

        $request->user()->notebooks()->create([
            'uid' => $uid,
            'title' => $request->title,
        ]);

        return response()->json($uid, 200);
    }

    public function show(NoteBook $notebook)
    {
        $this->authorize('show', $notebook);

        return view('notebooks.show', [
            'notebook' => $notebook,
        ]);
    }

    public function edit(NoteBook $notebook)
    {
        $this->authorize('edit', $notebook);

        return view('notebooks.edit', [
            'notebook' => $notebook,
        ]);
    }

    public function update(NoteBookFormRequest $request, NoteBook $notebook)
    {
        $this->authorize('edit', $notebook);

        $notebook->update([
            'title' => $request->title,
        ]);

        return redirect()->route('notebooks.home');
    }

    public function destroy(NoteBook $notebook)
    {
        $this->authorize('delete', $notebook);

        $notebook->delete();

        return response()->json(null, 200);
    }

}
