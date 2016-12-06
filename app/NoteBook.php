<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteBook extends Model
{

    use SoftDeletes;

    /**
     * Notebook model's table in the database.
     *
     * @var string
     */
    protected $table = 'note_books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'title',
    ];

    /**
     * Returns the field that NoteBook instances will be identified by.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uid';
    }

    /**
     * Each NoteBook has many Note instances.
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Each NoteBook belongs to a User.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
