<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    //public  $timestamps = false;

    protected $fillable = [
        'word',
        'grammar_type',
        'lang_id',
    ];

    public function Translations()
    {
        return $this->hasMany('App\Models\Translation', 'word_id');
    }

}
