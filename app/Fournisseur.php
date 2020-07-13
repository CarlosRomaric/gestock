<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Fournisseur extends Model
{
    
    //Table name
    protected $table = 'fournisseurs';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    public static function listeFournisseurs()
    {
        return $query = Fournisseur::orderBy('created_at','desc')->get();
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }

    public static function getRequestVerifyFournisseur($nom)
    {
        return $query = Fournisseur::orderBy('created_at', 'desc')->where('nom','=',$nom)->first();
    }

}
