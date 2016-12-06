<?php

namespace App\Policies;

use App\User;
use App\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Would be more convenient to use NoteBook as param instead of Note, but to
     * make this Policy associate with the correct model, Note, we must pass in Notes.
     *
     * Alternative option, simply relying on the NoteBookPolicy, as the logic and params are the same,
     * but seperating the different model's logic is a good idea.
     */

    public function edit (User $user, Note $note)
    {
        return $user->id === $note->notebook()->first()->user()->first()->id;
    }

    public function update (User $user, Note $note)
    {
        return $user->id === $note->notebook()->first()->user()->first()->id;
    }

    public function delete (User $user, Note $note)
    {
        return $user->id === $note->notebook()->first()->user()->first()->id;
    }
}
