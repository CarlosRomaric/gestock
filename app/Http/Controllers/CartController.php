<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Produit;
use App\Technicien;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //dd(Cart::content());
            $techs = Technicien::listeTechniciens();
            //dd($techs);
            $tech =  [];
            foreach($techs as $t){
                $tech[$t->id] = $t->nom.' '.$t->prenoms;
            }
            //dd($tech);
            $techniciens = $tech;
            //dd($techniciens);
            $cartproduct = Cart::content();
            //dd($cartproduct);

         $data = [
             'techniciens'=>$techniciens,
             'cartproduct'=>$cartproduct
         ];
         return view('cart.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $produit = Produit::find($request->produit_id);
    //    if(empty($request->qteStock))
    //    {
    //        return back()->with('danger','Entrer la quantité du produit choisi');    
    //    }elseif($request->qteStock > $produit->qteStock){
            
    //         return back()->with('danger','la quantité du produit choisi est supérieur a la quantité en stock');
    //    }

       $duplicata = Cart::search( function($cartItem, $rowId) use($request){
           return $cartItem->id == $request->produit_id;
       });

       if($duplicata->isNotEmpty()){
            return back()->with('danger','le produit a été  déjà ajouté au panier consulter votre panier pour modifier la quantité du produit');
       }
       Cart::add($produit->id, $produit->designation, 1, $produit->price)
             ->associate('App\Produit');
        return back()->with('message','le produit a bien été ajouté au panier');
    }

    public function videpanier(){
        Cart::destroy();
        return back()->with('message','le panier a bien été vidé');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();
        //dd($data);
        Cart::update($rowId, $data['qty']);

        Session::flash('success', 'la quantité a bien est passée à '.$data['qty'].'.');
        return response()->json(['success'=>'la quantité a bien été modifié']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
         Cart::remove($rowId);
         return back()->with('success','le produit a bien été rétiré du panier');
    }
}
