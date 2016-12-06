<?php

namespace App\Http\Controllers;

use App\Note;
use App\NoteBook;
use Illuminate\Http\Request;
use App\Http\Requests\NoteFormRequest;

class NoteController extends Controller
{
    /**
     * Create a Note.
     * Used by NoteBookShowComponent Vue component.
     *
     * @param  App\Http\Requests\NoteFormRequest $request
     * @param  App\Notebook                      $notebook
     * @return Illuminate\Http\Response
     */
    public function create(NoteFormRequest $request, NoteBook $notebook)
    {
        // policy nor gates work here.. policy won't work because Laravel is associating the
        // NoteBook class with the NoteBookPolicy so when I pass in an instance of Notebook
        // as a param to the authorize() helper in the Note class, it is using the NoteBookPolicy, rather than NotePolicy.
        // Not sure why Gates aren't working here..
        // This is the only way of currently 'authorizing' this action- creating a Note
        if (! $request->user()->id === $notebook->user_id) {
            abort(403);
        }

        $uid = uniqid(true);

        $notebook->notes()->create([
            'uid' => $uid,
            'content' => $request->content,
        ]);

        return response()->json($uid, 200);
    }

    /**
     * Displays for for editing a Note.
     *
     * @param  App\NoteBook $notebook
     * @param  App\Note     $note
     * @return Illuminate\Http\Response
     */
    public function edit(NoteBook $notebook, Note $note)
    {
       $this->authorize('edit', $note);

        return view('note.edit', [
            'notebook' => $notebook,
            'note' => $note,
        ]);
    }

    /**
     * Updates the Note.
     *
     * @param  Illuminate\Http\NoteFormRequest  $request
     * @param  App\NoteBook                     $notebook
     * @param  App\Note                         $note
     * @return Illuminate\Http\Response
     */
    public function update(NoteFormRequest $request, NoteBook $notebook, Note $note)
    {
        $this->authorize('update', $note);

        $note->update([
            'content' => $request->content,
        ]);

        return redirect()->route('notebook.show', [
            'notebook' => $notebook,
        ]);
    }

    /**
     * Deletes a Note.
     * Used by NoteBookShowComponent Vue component.
     *
     * @param  App\NoteBook $notebook
     * @param  App\Note     $note
     * @return Illuminate\Http\Response
     */
    public function destroy(NoteBook $notebook, Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return response()->json(null, 200);
    }

}
