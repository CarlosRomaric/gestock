<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SeuilProduitAtteint;
use App\Produit;
use App\Technicien;
use App\Sortie;
use App\BonSortie;

class SortieController extends Controller
{
    protected  $rules = [
     'user_id'=>'required',
     'technicien_id'=>'required',
     'date'=>'required',
    ];

    protected $messages = [
        'required'=>'le champ :attribute est requis'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        Cart::destroy();
    }

    public function sortieProduit()
    {
        $produits = Produit::listeProduits();
        //dd($produits);
        $data = [
            'produits'=>$produits
        ];
        return view('sorties.sortieProduit')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cart::destroy();
        //dd(getListeProduitInferieurStock());
        //dd(nbreProduitsInferieurStock());
        //dd(getProduits());
        $sorties = BonSortie::listeBonSorties();
        //dd($sorties);
        $data = [
            'sorties'=>$sorties
        ];
        return view('sorties.index')->with($data);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $data = $request->all();
        //dd(Cart::content());
        $data = [];
        $data2 = [
            'user_id'=>$request->user_id,
            'technicien_id'=>$request->technicien_id,
            'status'=>0,
            'date'=>date('Y-m-d H:i:s')
        ];
       
        BonSortie::create($data2);
        $bon_sorties_id = BonSortie::lastRecordBonSortieId();
        foreach (Cart::content() as $key => $product) {
           $data = [
               'produit_id'=>$product->id,
               'bon_sorties_id'=>$bon_sorties_id,
               'date'=>$request->date,
               'qteStock'=>$product->qty
           ];
          //dd($data);
         Sortie::create($data);
        }
        return redirect('sorties')->with('message','cet bon de sortie a bien été pris en compte et doit être valider par le responsable avant la sortie des produits du stock');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bonSortie = BonSortie::find($id);
        $sorties = Sortie::listeSorties($id);
        $data = [
            'bonSortie'=>$bonSortie,
            'sorties'=>$sorties,
        ];
        return view('sorties.show')->with($data);
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
        $bonSortie = BonSortie::find($id);

        $sorties = Sortie::listeSorties($id);
        //$produit=Produit::listeProduitById($sortie->produit_id);
        //dd($sorties);
        foreach($sorties as $sortie){
            $produit = Produit::find($sortie->produit_id);
            
            $data = [
                'qteStock'=>$produit->qteStock - $sortie->qteStock,
            ];
            $produit->update($data);
           // $produits=Produit::listeProduitById($sortie->produit_id);
           //Notification
        //    if($produit->qteStock == $produit->qteMin ){
        //         dd($produit->user->notify(new SeuilProduitAtteint($produit)));
        //    }elseif($produit->qteStock <= $produit->qteMin){
        //         dd($produit->user->notify(new SeuilProduitAtteint($produit)));
        //    }
          
        }
        $data2 = [
            'status'=>1
        ];
        $bonSortie->update($data2);
        

        return redirect('sorties')->with('message','le le bon de sortie a bien été validé');
        //dd($produits);
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
