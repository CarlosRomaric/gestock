<?php

namespace App\Http\Controllers;

use App\Entree;
use App\RetourStock;
use App\Technicien;
use App\Produit;
use App\Retour;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetourStockController extends Controller
{
    protected $rules = [
        'user_id'=>'required',
        'technicien_id'=>'required'
    ];

    protected $messages = [
        'required'=>'Le Champ :attributes est requis'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retourStocks = RetourStock::listeRetourStocks();

        //dd($retourStocks);
        $data = [
            'retourStocks'=> $retourStocks
        ];
        return view('retourStocks/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $techs = Technicien::listeTechniciens();
            //dd($techs);
            $tech =  [];
            foreach($techs as $t){
                $tech[$t->id] = $t->nom.' '.$t->prenoms;
            }
            //dd($tech);
            $techniciens = $tech;
            $produits = Produit::listeProduits();
        $data = [
            'techniciens'=>$techniciens,
            'produits'=>$produits
        ];
        return view('retourStocks/create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, $this->rules, $this->messages);

        $data = RetourStock::getRequest($request);
        //dd($data);
        $dataRetourStock = Arr::except( $data, ['example2_length', 'produit_id', 'qteStock','poids']);
        $dataproduits = Arr::except($data, ['example2_length', 'user_id', 'technicien_id','qteStock','poids','_token']);
        $dataqtestock = Arr::except($data, ['example2_length', 'user_id', 'technicien_id', 'produit_id','poids','_token']);
        $datapoids = Arr::except($data, ['example2_length', 'user_id', 'technicien_id', 'produit_id', 'qteStock','_token']);
        $dataQteStock=[];
        $dataPoids=[];
        $produits = [];
        foreach ($dataqtestock as $key => $value) {

            // }
            foreach ($value as $key2 => $v) {
              if($v != null){
                $dataQteStock[$key2] = $v;
              }
            }

        }
        foreach ($dataproduits as $key => $value) {
            foreach ($value as $key2 => $v) {
                  $dataproduits[$key2] = $v;
              }
        }
        foreach ($datapoids as $key => $value) {
            foreach ($value as $key2 => $v) {
                $dataPoids[$key2]=$v;
            }
        }
        $dataproduits = Arr::except($dataproduits, ['produit_id']);
        //dd($dataproduits, $dataQteStock);
        /**
         * Pour l'enregistrement dans la table retour en stocks on aura
         */
        //dd($dataRetourStock);
        RetourStock::create($dataRetourStock);
        $retourStocks_id = RetourStock::lastRecordRetourStocksId();
        //dd($dataQteStock);
        //dd($dataPoids);
        $lastRecordRetour =[];
            foreach ($dataQteStock as $key => $value) {

                    $produit = Produit::find($key);
                    $qteStock = Produit::find($key)->qteStock;
                    $data = [
                        'produit_id'=>$key,
                        'retourStocks_id'=>$retourStocks_id,
                        'date'=>date('Y-m-d H:i:s'),
                        'qteStock'=> $value,
                    ];

                    $data2['qteStock'] = $qteStock + $value;
                    $produit->update($data2);
                    $data4 = [
                        'produit_id'=>Produit::lastRecordproduitId()->id,
                        'user_id'=>Auth::user()->id,
                        'qteStock'=>$data['qteStock'],
                        'date'=>date('Y-m-d H:i:s')
                    ];
                    //dd($data2);
                    Entree::create($data4);
                    Retour::create($data);
                    $lastRecordRetour[] = Retour::lastRecordRetourId();
            }
            //dd($lastRecordRetour);


            foreach ($dataPoids as $key => $value) {
                $produit = Produit::find($key);
                $poids = Produit::find($key)->poids;

                $data2['poids'] = $poids + $value;
                $produit->update($data2);

                foreach ($lastRecordRetour as $k => $v) {
                    $retour = Retour::find($v);
                    $data3['poids'] = $value;
                    $retour->update($data3);
                }
           }



       return redirect('retourStocks')->with('message','Le retour en stock a bien été éffectué');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retourStock = RetourStock::find($id);
        $retours = Retour::listeRetoursById($id);

        $data = [
            'retourStock'=>$retourStock,
            'retours'=>$retours
        ];

        return view('retourStocks/show')->with($data);
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
