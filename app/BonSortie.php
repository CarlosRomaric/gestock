<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BonSortie extends Model
{
    //Table name
    protected $table = 'bon_sorties';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    protected $dates = ['date'];

    public static function listeBonSorties()
    {
        return $query = BonSortie::orderBy('created_at','desc')->get();
    }

    public static function lastRecordBonSortieId()
    {
        return $query = DB::table('bon_sorties')->latest('id')->first()->id;
    }

    public static function nomUserBySortie($id)
    {
        return $data = BonSortie::orderBy('created_at','desc')->where('id','=',$id)->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function technicien()
    {
        return $this->belongsTo('App\Technicien');
    }

    public function sortie()
    {
        return $this->belongsToMany('App\Sortie');
    }
}
