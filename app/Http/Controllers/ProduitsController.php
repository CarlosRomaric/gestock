<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Produit;
use App\Famille;
use App\Fournisseur;
use App\Entree;
use App\Sortie;

class ProduitsController extends Controller
{
    protected $rules = [
        'designation'=>'required',
        'ref'=>'required',
        'subtitle'=>'required',
        'description'=>'required',
        'price'=>'required',
        'qteStock'=>'required',
        'qteMin'=>'required',
        'famille_id'=>'required',
        'fournisseur_id'=>'required',
        'image'=>'mimes:jpg,jpeg,png,gif,bmp'
    ];

    protected $messages = [
        'required'=>'Le champ :attribute est requis',
        'mimes'=>'l\' image doit être du type jpg,jpeg,png,gif ou bmp '
    ];

    protected $upload = 'public/images_produits';

    public function __construct()
    {
      $this->middleware('auth');
      $this->upload = base_path().'/'.$this->upload;
       Cart::destroy();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::listeProduits();
       
        $data = [
            'produits'=>$produits,
        ];
        return view('produits.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produit = '';
        $selected ='';
        $selected2='';
        $familles = Famille::listeFamille()->pluck('libelle','id');
        $fours = Fournisseur::listeFournisseurs();
        $four =  [];
        foreach($fours as $f){
            $four[$f->id] = $f->nom.' '.$f->prenoms;
        }
        //dd($four);
        $fournisseurs = $four;
        $idproduit = '';
        $data = [
            'produit'=>$produit,
            'familles'=>$familles,
            'fournisseurs'=>$fournisseurs,
            'disabled'=>'',
            'selected'=>$selected,
            'selected2'=>$selected2,
            'idproduit'=>$idproduit
        ];
        return view('produits.create')->with($data);
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
        $data = Produit::getRequest($request, $this->upload);
        if(Produit::getVerifyProduitExist($data['ref'], $data['designation'])){
            return back()->with('danger','cet produit existe déjà dans la base de donnée');
        }
        Produit::create($data);

        $data2 = [
            'produit_id'=>Produit::lastRecordproduitId()->id,
            'user_id'=>Auth::user()->id,
            'qteStock'=>$data['qteStock'],
            'date'=>date('Y-m-d H:i:s')
        ];
        //dd($data2);
        Entree::create($data2);
        return redirect('produits')->with('message','cet produit a bien été Enregistré au dépôt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $produit = Produit::find($id);
        $entrees = Entree::listeEntreeByproduitId($id);
        $sorties = Sortie::listeSortieByProduitId($id);
        $data = [
            'produit'=>$produit,
            'entrees'=>$entrees,
            'sorties'=>$sorties
        ];
        //dd($sorties);
        //dd($produit['qteStock']);
        return view('produits.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produit = Produit::find($id);
        $familles = Famille::listeFamille()->pluck('libelle','id');
        //dd($familles);
        $fours = Fournisseur::listeFournisseurs();
        $four =  [];
        
        foreach($fours as $f){
            $four = [
                $f->id => $f->nom.' '.$f->prenoms,
            ];
           
        }
        //dd($four);
        $fournisseurs = Fournisseur::listeFournisseurs()->pluck('nom','id');
        //dd($familles);
        //dd($fournisseurs);
        //$disabled = (route('produits.edit', $produit->id) == url()->current() )? 'disabled="disabled"' : '' ;
        $disabled = '';

        $selected ='';
        $selected2 ='';
         foreach ($familles as $key => $value) {
            if ($key == $produit->famille_id) {
                $selected= $key; 
            }
        }

         foreach ($fournisseurs as $key2 => $value) {
            if ($key2 == $produit->fournisseur_id) {
                $selected2 = $key2; 
            }
        }

        //dd($selected2);
       
        $idproduit = $produit->id;
        $data = [
            'produit'=>$produit,
            'familles'=>$familles,
            'fournisseurs'=>$fournisseurs,
            'disabled'=>$disabled,
            'selected'=>$selected,
            'selected2'=>$selected2,
            'idproduit'=>$idproduit
        ];
        return view('produits.edit')->with($data);
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
        //dd($request->all());
        $this->validate($request, $this->rules, $this->messages);
        $produit = Produit::find($id);
        $data = Produit::getRequest($request, $this->upload);
        //dd($data);
        if (empty($data['image'])) {
            $data['image']= $produit->image;
        }
        $produit->update($data);
        return redirect('produits')->with('message','cet produit a bien été modifié');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit = Produit::find($id);
        Produit::removeImage($produit->image, $this->upload);
        $produit->delete();    
        return  redirect('produits')->with('message','cet produit a bien été supprimer');
    }
}
