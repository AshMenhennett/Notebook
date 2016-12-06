<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Each User has many NoteBook instances.
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notebooks()
    {
        return $this->hasMany(NoteBook::class);
    }

    /**
     * Each User has many Note instances, through a NoteBook
     *
     * @return Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function notes()
    {
        return $this->hasManyThrough(Note::class, NoteBook::class);
    }


}
