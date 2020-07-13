<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sortie extends Model
{
    //Table name
    protected $table = 'sorties';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    protected $dates = ['date'];

    public function produit()
    {
        return $this->belongsTo('App\Produit');
    }

    public function bonSortie()
    {
        return $this->belongsTo('App\BonSortie');
    }

    public function technicien()
    {
        return $this->belongsTo('App\Technicien');
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }

    public static function listeSorties($id)
    {
        return $query = Sortie::orderBy('created_at','desc')->where('bon_sorties_id','=',$id)->get();
    }

    public static function listeSortieByproduitId($id)
    {
        return $data = Sortie::orderBy('created_at','desc')->where('produit_id','=',$id)->get();
    }

    
    
    
}
