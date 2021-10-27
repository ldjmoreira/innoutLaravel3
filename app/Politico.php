<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Politico extends Model
{
    protected $fillable = [
        'name', 'partido'
    ];

    public $timestamps = false;

    public function Reclamacaos()
    {
        return $this->hasMany('App\Reclamacao');
    }
}
