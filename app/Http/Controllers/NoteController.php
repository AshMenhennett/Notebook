<?php

namespace App\Http\Controllers;

use App\Note;
use App\NoteBook;
use Illuminate\Http\Request;
use App\Http\Requests\NoteFormRequest;

class NoteController extends Controller
{

    public function create(NoteFormRequest $request, NoteBook $notebook)
    {
        $this->authorize('create', $notebook);

        $uid = uniqid(true);

        $notebook->notes()->create([
            'uid' => $uid,
            'content' => $request->content,
        ]);

        return redirect()->route('notebooks.show', [
            'notebook' => $notebook,
        ]);
    }

    public function edit(NoteBook $notebook, Note $note)
    {

        $this->authorize('edit', $notebook);

        return view('note.edit', [
            'notebook' => $notebook,
            'note' => $note,
        ]);
    }

    public function update(NoteFormRequest $request, NoteBook $notebook, Note $note)
    {

        $this->authorize('update', $notebook);

        $note->update([
            'content' => $request->content,
        ]);

        return redirect()->route('notebooks.show', [
            'notebook' => $notebook,
        ]);
    }

    public function destroy(NoteBook $notebook, Note $note)
    {

        $this->authorize('delete', $notebook);

        $note->delete();

        return redirect()->route('notebooks.show', [
            'notebook' => $notebook,
        ]);
    }

}
