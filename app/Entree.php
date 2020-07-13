<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Entree extends Model
{
    //Table name
    protected $table = 'entrees';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    protected $dates = ['date'];

    public static function listeEntrees()
    {
        return $query = Entree::orderBy('created_at','desc')->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }

    public static function listeEntreeByproduitId($id)
    {
        return $data = Entree::orderBy('created_at','desc')->where('produit_id','=',$id)->get();
    }
}
