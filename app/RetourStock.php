<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetourStock extends Model
{
    //Table name
    protected $table = 'retour_stocks';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    protected $guarded = [];

    protected $dates = ['created_at'];

    public static function  listeRetourStocks()
    {
        return RetourStock::orderBy('created_at','desc')->get();
    }



    public function retour()
    {
        return $this->belongsToMany('App\Retour');
    }

    public function technicien()
    {
        return $this->belongsTo('App\Technicien');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }

    public static function lastRecordRetourStocksId()
    {
        return $query = DB::table('retour_stocks')->latest('id')->first()->id;
    }
}
