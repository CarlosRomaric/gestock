<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Technicien;
use App\Produit;


class TechnicienController extends Controller
{
    protected $rules = [
        'nom'=>'required',
        'prenoms'=>'required',
        'matricule'=>'required',
        'email'=>'required',
        'contacts'=>'required'
    ];

    protected $messages = [
        'required'=>'le champ :attribute est requis'
    ];
    public function __constrtuct()
    {
         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $techniciens = Technicien::listeTechniciens();
        Cart::destroy();
        $data = [
            'techniciens'=>$techniciens
        ];
        return view('technicien.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $techniciens = '';
        $data = [
            'techniciens'=>$techniciens
        ];
        return view('technicien.create')->with($data);
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
        $data = Technicien::getRequest($request);
        if(Technicien::getVerifyTechnicienExist($data['matricule'], $data['email']))
        {
            return back()->with('danger','ce technicien existe déjà');
        }
        Technicien::create($data);
        return redirect('technicien')->with('message','cet technicien a bien été enregistré');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produits = Produit::listeProduits();
        $technicien = Technicien::find($id);
        $data = [
            'produits'=>$produits,
            'technicien'=>$technicien
        ];
        return view('technicien.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $technicien = Technicien::find($id);
        $data = [
            'technicien'=>$technicien
        ];
        return view('technicien.edit')->with($data);
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
        $data = Technicien::getRequest($request);
        $technicien = Technicien::find($id);
        $technicien->update($data);
        return redirect('technicien')->with('message','cet technicien a bien été enregistré');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $technicien = Technicien::find($id);
        $technicien->delete();
        return redirect('technicien')->with('message','cet technicien a bien été enregistré');
    }
}
