<?php

namespace App\Policies;

use App\User;
use App\NoteBook;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoteBookPolicy
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

    public function show (User $user, NoteBook $notebook)
    {
        return $user->id === $notebook->user_id;
    }

    public function edit (User $user, NoteBook $notebook)
    {
        return $user->id === $notebook->user_id;
    }

    public function update (User $user, NoteBook $notebook)
    {
        return $user->id === $notebook->user_id;
    }

    public function delete (User $user, NoteBook $notebook)
    {
        return $user->id === $notebook->user_id;
    }

}
