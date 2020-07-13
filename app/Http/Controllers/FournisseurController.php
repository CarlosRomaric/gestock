<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Fournisseur;

class FournisseurController extends Controller
{
    protected $rules = [
        'nom'=>'required',
        'email'=>'required',
        'contact'=>'required'
    ];

    protected $messages = [
        'required'=>' le champ :attribute est requis',
    ];

    public function __construct()
    {
      $this->middleware('auth');
       Cart::destroy();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::listeFournisseurs();
        $data = [
            'fournisseurs'=>$fournisseurs
        ];

        return view('fournisseur.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = '';
        $data = [
            'fournisseurs'=>$fournisseurs
        ];
        
        return view('fournisseur.create')->with($data);
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
        $data = Fournisseur::getRequest($request);
         if( Fournisseur::getRequestVerifyFournisseur($data['nom']) ){
            return back()->with('danger','Cet Fournisseur de produit a déjà été enregistré');
        }
        Fournisseur::create($data);
        return redirect('fournisseur')->with('message','cet fournisseur a bien été enregistré');
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
        $fournisseur = Fournisseur::find($id);
        $data = [
            'fournisseur'=>$fournisseur,
        ];

        return view('fournisseur.edit')->with($data);
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
        $this->validate($request, $this->rules, $this->messages);
        $fournisseur = Fournisseur::find($id);
        $data = Fournisseur::getRequest($request);
        $fournisseur->update($data);
        return redirect('fournisseur')->with('message','les informations du fournisseur ont bien été confirmer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::find($id);
        $fournisseur->delete();
        return redirect('fournisseur')->with('message', 'lefournisseur a bien été supprimé');
    }
}
