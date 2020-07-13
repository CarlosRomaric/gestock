<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\User;
use App\Produit;
use App\Technicien;
use App\Fournisseur;
use App\Famille;

class MainController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
       Cart::destroy();
    }

    public function index()
    {
       $nbre_users = User::nbreUsers();
       $nbre_produits = Produit::nbreProduits();
       $nbre_Technicien = Technicien::nbreTechniciens();
       $stock_produits = Produit::stockProduits();
    
       //dd($totalDepenses);
       //dd($totalSubventions);
       //$totalCaisse = $totalCotisationMensuelles + $droitAdhesion + $totalSubventions - $totalDepenses;
       //dd($totalCaisse);
       $data = [
         'nbre_users'=>$nbre_users,
         'nbre_produits'=>$nbre_produits,
         'nbre_Technicien'=>$nbre_Technicien,
         'stock_produits'=>$stock_produits
       ];
       return view('main/index')->with($data);
    }
    
}
