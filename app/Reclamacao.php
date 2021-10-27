<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclamacao extends Model
{
    protected $fillable = [
        'titulo', 'area','politico_id', 'descricao','thumblink','datap', 'texto'
    ];
    public $timestamps = false;
    public function politico()
    {
        return $this->belongsTo('App\Politico');
    }
}
