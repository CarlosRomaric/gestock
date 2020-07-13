<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Technicien extends Model
{
    //Table name
    protected $table = 'techniciens';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    public function bonSortie()
    {
        return $this->belongsToMany('App\BonSortie');
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }

    public static function listeTechniciens()
    {
        return $query = Technicien::orderBy('created_at','desc')->get();
    }
    

    public static function nbreTechniciens()
    {
        return $query = Technicien::all()->count();
    }

    public static function getVerifyTechnicienExist($matricule, $email)
    {
        return $query = Technicien::orderBy('created_at','desc')->where('matricule','=',$matricule)->where('email','=',$email)->first();
    }
}
