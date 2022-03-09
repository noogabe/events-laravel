<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /* Assinalando que 'items' deve ser entendido como um array */
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
