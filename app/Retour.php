<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Retour extends Model
{
    //Table name
    protected $table = 'retours';
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

    public function retourStocks()
    {
        return $this->belongsTo('App\RetourStocks');
    }

    public function technicien()
    {
        return $this->belongsTo('App\Technicien');
    }

    public static function listeRetours()
    {
        return $query = Retour::orderBy('created_at','desc')->get();
    }

    public static function listeRetoursById($id)
    {
        return $query = Retour::orderBy('created_at','desc')->where('retourStocks_id',$id)->get();
    }

    public static function lastRecordRetourId()
    {
        return $query = DB::table('retours')->latest('id')->first()->id;
    }
}
