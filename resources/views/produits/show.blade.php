@extends('layouts/layouts')

@section('content')
@include('inc/menu')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card">
                  <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" aria-label="Close" id="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          {{ session('message') }}
                        </div>
                    @endif
                    <h3 class="card-title text-center mb-5">Detail du produit {{ $produit->designation }}</h3>
                     <a href="{{ route('produits.index') }}" class="btn btn-primary mb-3">Liste de Produits</a>
                    <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center" >
                            <thead >
                                   
                                <tr class=" bg-secondary">
                                    <th class="">Image</th>
                                    <th class="">Reférence</th>
                                    <th class="">Designation</th>
                                    <th class="">Brève description</th>
                                    <th class="">Description</th>
                                    <th class="">Prix unitaire</th>
                                    <th class="">Stock</th>
                                    <th class="">Seuil d'alerte</th>
                                    <th class="">Montant Total</th>
                                    <th class="">Famille</th>
                                    <th class="">Fournisseur</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                   
                                <tr class="text-center">
                                    
                                    <td class=""> <img src="/images_produits/{{ $produit->image }}" alt=""></td>
                                    <td class="">{{ $produit->ref }} </td>                                           
                                    <td class="">{{ $produit->designation }} </td>                                            
                                    <td class="">{{ $produit->subtitle }} </td>                                            
                                    <td class="">{{ $produit->description }} </td>                                            
                                    <td class="">{{ getPrice($produit->price) }} </td>
                                    <td class="">{{ $produit->qteStock }} </td>
                                    <td class="">{{ $produit->qteMin }} </td>
                                    <td class="">{{ getPrice($produit->qteStock * $produit->price) }} </td>
                                    <td class="">{{ $produit->famille->libelle }}</td>
                                    <td class="">{{ $produit->fournisseur->nom }}  </td>
                                   
                                </tr>
                                  
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-12 mt-5">
                          <button class="btn btn-success" data-toggle="modal" data-target="#entree">Entrée en stock</button>
                          <a href="{{ route('sortie.sortieProduit') }}" class="btn btn-danger"> Faire une Sortie</a>
                        <div class="row">
                             <div class="table-responsive mt-5 col-md-12">
                                 <p class=""><h4 class="text-center text-uppercase">Mouvement de {{ $produit->designation }}</h4></p>
                                <table class="table table-bordered table-hover table-sm " id="example2">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th>N°</th>
                                            <th>Quantité</th>
                                            <th>Date</th>
                                            <th>Magasinier</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $i=0; ;?>
                                        @foreach( $entrees as $entree)
                                         <?php $i++; ;?>
                                        <tr>
                                            <td> {{ $i }} </td>
                                            <td> {{ $entree->qteStock }} </td>
                                            <td> {{ $entree->date->format('d/m/Y') }} à {{ $entree->date->format('H').' h '.$entree->date->format('i').' min '.$entree->date->format('s') }}  </td>
                                            <td> {{ $entree->user->name }}</td>
                                            <td>Entrée</td>
                                        </tr>
                                        @endforeach

                                         @foreach( $sorties as $sortie)
                                         <?php $i++; ;?>
                                         
                                        <tr>
                                            <td> {{ $i }} </td>
                                            <td> {{ $sortie->qteStock }} </td>
                                            <td> {{ $sortie->date->format('d/m/Y') }} à {{ $sortie->date->format('H').' h '.$sortie->date->format('i').' min '.$sortie->date->format('s') }}  </td>
                                            <td> {{ App\User::getUserById( App\BonSortie::nomUserBySortie($sortie->bon_sorties_id)[0]->user_id )->name }}</td>
                                            <td>Sortie</td>
                                        </tr>
                                        @endforeach
                                        
                                        <!--<tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Sortie</td>
                                        </tr>-->
                                    </tbody>
                                </table>
                             </div>
                             
                        </div>
                         
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
             

<div class="modal fade" id="entree" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="entreeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="entreeLabel">Entrée en Stock du produit {{ $produit->designation }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('entree.store') }}" method="POST">
        @csrf
        <div class="modal-body">
           @include('entree/form')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>
           
@endsection