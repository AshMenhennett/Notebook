<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteBook extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'title',
    ];

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
