<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Article extends Model
{
      //Table name
    protected $table = 'articles';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    public function produit(){
        return $this->hasMany('App\Produit');
    }

    public static function listeArticle()
    {
        return $query = Article::orderBy('created_at','desc')->get();
    }

    public static function nbreArticle()
    {
        return $query = Article::all()->count();
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }

    public static function getRequestVerifyLibelle($libelle)
    {
        return $query = Article::orderBy('created_at', 'desc')->where('libelle','=',$libelle)->first();
    }
}
