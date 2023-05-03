<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $fillable=[
        'id',
        'idClient',
        'username',
        'password',
        'solde',
        'type'
    ];
    public function Client()
    {
       
        return $this->belongsTo(Client::class);
    }
    public function getPassword(){
        return $this->$fillable['password'];
    }
    public function verser(Compte $compte,$montant)
    {
        if($montant<$this->solde){
        $this->solde=$this->solde-$montant;
        $compte->solde=$compte->solde+$montant;
        $this->save();
        $compte->save();
        return true;
        }
        return false;
    }

    public static function compteParClient($client)
    {
        return Compte::where('idClient',$client)->get();
    }
}
