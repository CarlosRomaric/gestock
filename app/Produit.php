<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Produit extends Model
{
    //Table name
    protected $table = 'produits';
    //Primary key
    protected $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    
    protected $guarded = [];

    public function sortie()
    {
        return $this->belongsToMany('App\Sortie');
    }

    public function famille(){
        return $this->belongsTo('App\Famille');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function produits()
    {
        return $this->belongsToMany('App\Produit');
    }

    public function fournisseur(){
        return $this->belongsTo('App\Fournisseur');
    }

    public static function listeProduits()
    {
        return $query = Produit::orderBy('created_at','desc')->get();
    }

    public static function nbreProduits($value='')
    {
         return $query = Produit::all()->count();
    }
    
    public static function getRequest(Request $request, $upload)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = $image->getClientOriginalName().time();
            $destination =  $upload;
            $image->move($destination, $imageFileName);
            $data = $request->all();
            $data['image'] =  $imageFileName;
        }
        else{
            $imageFileName = '';
            $data = $request->all();
            $data['image'] =  $imageFileName;
        }
        return $data;
    }

    public static function getVerifyProduitExist($ref, $designation)
    {
        return $query = Produit::orderBy('created_at', 'desc')->where('designation','=',$designation)->where('ref','=',$ref)->first();
    }

    public static function removeImage($image, $upload)
    {
        if (! empty($image) && $image != 'default.png') {
            $file_path = $upload.'/'.$image;
            if(file_exists($file_path)) unlink($file_path);
        }
    }
    
    public static function lastRecordProduitId()
    {
        return $query = DB::table('produits')->latest('id')->first();
    }

    public static function stockProduits()
    {
        return $query =  Produit::all()->sum('qteStock');
    }
    
    public static function getQteStockById($id){
        return $query = Produit::find($id)->qteStock;
    }

    public static function listeProduitById($id)
    {
        return $query = Produit::where('id','=',$id)->get();
    }

    public static function listeSortieByProduitId($id)
    {
        return $query = Produit::where('id','=',$id)->get();
    }

    public static function getPrice($price)
    {
        $price = floatval($price);
        return number_format($price,0,' ',' ').' FCFA';
    }
}
