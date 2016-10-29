<?php

namespace App\Http\Controllers;

use App\Note;
use App\NoteBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\NoteFormRequest;

class NoteController extends Controller
{

    public function create(NoteFormRequest $request, NoteBook $notebook)
    {
        // check if doesn't own notebook, if they don't, let's return.
        // wouldn't work with authorization, passing in the current $notebook..
        if ($request->user()->id !== $notebook->user_id) {
            return;
        }

        $uid = uniqid(true);

        $notebook->notes()->create([
            'uid' => $uid,
            'content' => $request->content,
        ]);

        return response()->json($uid, 200);
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

        return response()->json(null, 200);
    }

}
