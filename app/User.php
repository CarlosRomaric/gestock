<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password', 'role', 'matricule', 'contacts'
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sortie()
    {
        return $this->belongsTo('App\Sortie');
    }

    public function bonSortie()
    {
        return $this->belongsToMany('App\BonSortie');
    }

    public function produits()
    {
        return $this->belongsToMany('App\Produit');
    }

    public function entree()
    {
        return $this->belongsTo('App\Entree');
    }

    public function scopeRole($query)
    {
        return $query->where('role', 0)->get();
    }

    public static function listeUsers()
    {
       return $query =  User::orderBy('created_at','desc')->get();
       
    }

    public static function listeUsersTechnicien($status)
    {
        return $query =   User::orderBy('created_at','desc')->where('role','=',$status)->get();
    }

    public static function nbreUsers()
    {
        return $query =  User::all()->count();
    }

    public static function nbreUsersTechnicien($status)
    {
        return $query =   User::orderBy('created_at','desc')->where('role','=',$status)->get()->count();
    }

    public static function getUserById($id)
    {
         return $query =   User::orderBy('created_at','desc')->where('id','=',$id)->first();
    }

    public static function getRequest(Request $request)
    {
        return $data = $request->all();
    }
}
