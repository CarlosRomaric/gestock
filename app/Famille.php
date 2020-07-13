<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Famille extends Model
{
    //Table name
    protected $table = 'familles';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    public function produit(){
        return $this->hasMany('App\Produit');
    }

    public static function listeFamille()
    {
        return $query = Famille::orderBy('created_at','desc')->get();
    }

    public static function nbreFamille()
    {
        return $query = Famille::all()->count();
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }

    public static function getRequestVerifyLibelle($libelle)
    {
        return $query = Famille::orderBy('created_at', 'desc')->where('libelle','=',$libelle)->first();
    }
    
}
