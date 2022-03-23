<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];
    
    /* Assinalando que 'items' deve ser entendido como um array */
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = [
        'date' => 'Y-m-d'
    ];

    /* Relação de pertencimento
    * Um evento pertence a um usuário */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
