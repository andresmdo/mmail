<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = [
        'subject',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
