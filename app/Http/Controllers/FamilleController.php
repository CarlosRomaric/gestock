<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Famille;

class FamilleController extends Controller
{

    protected $rules = [
        'libelle'=>'required',
        'marque'=>'required',
        'modele'=>'required',
    ];

    protected $messages = [
        'required'=>'le champ :attribute a bien été enregistré'
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
        $familles = Famille::listeFamille();
        $data = [
            'familles'=>$familles
        ];

        return view('famille.index')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'famille'=>''
        ];
        return view('famille.create')->with($data);
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
        $data = Famille::getRequest($request);
        //dd($data);
        if( Famille::getRequestVerifyLibelle($data['libelle']) ){
            return back()->with('danger','Cette Famille de produit a déjà été enregistré');
        }
        Famille::create($data);
        return redirect('famille')->with('message','cette famille a bien été enregistré');
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
        $famille = Famille::find($id);
        $data = [
            'famille'=>$famille
        ];
        return view('famille/edit')->with($data);
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
        $data = Famille::getRequest($request);
        $famille = Famille::find($id);
        $famille->update($data);
        return redirect('famille')->with('message','Cette famille de produit a  été modifiées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $famille = Famille::find($id);
        $famille->delete();
        return redirect('famille')->with('message','cette famille a bien été supprimé');
    }
}
