<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'content',
    ];

    /**
     * Returns the field that Note instances will be identified by.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uid';
    }

    /**
     * Each Note belongs to a NoteBook
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function notebook()
    {
        return $this->belongsTo(NoteBook::class, 'note_book_id');
    }

}
