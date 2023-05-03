<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable=[
        'id',
        'nom',
        'dateN',
        'sexe'
    ];

    public function Compte()
    {
       
        return $this->hasMany(Compte::class);
    }

   
}
