<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Entree;
use App\Produit;

class EntreeController extends Controller
{
    protected $rules = [
        'qteStock'=>'required',
        'date'=>'required',
        'user_id'=>'required',
        'produit_id'=>'required'
    ];

    protected $messages = [
        'required'=>'le champ :attribute est requis'
    ];

    public function __construct()
    {
         Cart::destroy();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrees = Entree::listeEntrees();
        $sorties = Sortie::listeSortie();
        $data = [
            'entrees'=>$entrees
        ];
        return view('entree.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function listeEntreByproduitId($id)
    {
        $entrees = Entree::listeEntreesByProduitId($id);
        $data = [
            'entrees'=>$entrees
        ];
        return view('entree.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $data = Entree::getRequest($request);
        Entree::create($data);
        $produit = Produit::find($data['produit_id']);
        $data2 = [           
            'qteStock'=>$produit->qteStock + $data['qteStock'],        
        ];
        
        $produit->update($data2);
        return back()->with('message','la quantité en stock du produit a bien été ajouté');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
