<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body',
    ];

    public static $rules = [
        'body' => 'required|max:200'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
