<?php

namespace App\Http\Controllers;

use App\NoteBook;
use Illuminate\Http\Request;
use App\Http\Requests\NoteBookFormRequest;
class NoteBookController extends Controller
{

    public function index(Request $request)
    {
        $notebooks = $request->user()->notebooks()->get();

        return view('notebooks.index', [
            'notebooks' => $notebooks,
        ]);
    }

    public function create(NoteBookFormRequest $request)
    {

        $uid = uniqid(true);

        $request->user()->notebooks()->create([
            'uid' => $uid,
            'title' => $request->title,
        ]);

        return redirect()->route('notebooks.index');

    }

    public function show(NoteBook $notebook)
    {

        $this->authorize('show', $notebook);

        $notes = $notebook->notes()->get();

        return view('notebooks.show', [
            'notebook' => $notebook,
            'notes' => $notes,
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

        return redirect()->route('notebooks.index');
    }

    public function destroy(NoteBook $notebook)
    {

        $this->authorize('delete', $notebook);

        $notebook->delete();

        return redirect()->route('notebooks.index');
    }

}
