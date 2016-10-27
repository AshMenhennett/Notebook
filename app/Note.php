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

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function notebook()
    {
        return $this->belongsTo(NoteBook::class);
    }

}
