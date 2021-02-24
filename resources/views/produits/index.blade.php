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
                    <h3 class="card-title text-center mb-5">Liste des Articles</h3>
                     @if(Auth::user()->role==0)
                     <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un  Article</a>
                     @endif
                     <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center" id="example2">
                            <thead >

                                <tr class=" bg-secondary">
                                    <th>N°</th>
                                    @if(Auth::user()->role==0)
                                    <th class="text-center">Actions</th>
                                    @endif
                                    <th class="">Image</th>
                                    <th class="">Reférence</th>
                                    <th class="">N° Bon de Commande</th>
                                    <th class="">Designation</th>
                                    <th class="">Magasin</th>
                                    <th class="">Etagere</th>
                                    <th class="">Rangée</th>
                                    <th class="">Prix Achat</th>
                                    <th class="">Prix de vente</th>
                                    <th class="">Stock</th>
                                    <th class="">Poids</th>
                                    <th class="">Seuil d'alerte</th>
                                    <th class="">Famille</th>
                                    <th class="">Marque</th>
                                    <th class="">Modèle</th>
                                    <th class="">Fournisseur</th>

                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($produits as $produit)
                                    <?php $i++; ?>
                                        <tr class="text-center">
                                            <td>{{ $i }}</td>
                                            @if(Auth::user()->role==0)
                                            <td class="text-center">
                                                 <a class="btn btn-warning btn-sm" href="/produits/{{ $produit->id }}" title="Détail du produit">
                                                    <i class="icon-eye"></i>
                                                </a>
                                                <a class="btn btn-primary btn-sm" href="/produits/{{ $produit->id }}/edit" title="modifié les info du produits">
                                                    <i class="icon-note"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mb-delete_{{ $produit->id }}"><i class=" icon-trash"></i></button>
                                            </td>
                                            @endif
                                            <td class="">
                                                <img src="/images_produits/{{ $produit->image }}" alt="">

                                            </td>
                                            <td class="">{{ $produit->ref }} </td>
                                            <td class="">{{ $produit->numBonCommande }} </td>
                                            <td class="">{{ $produit->designation }} </td>
                                            <td class="">{{ $produit->magasin }} </td>
                                            <td class="">{{ $produit->etagere }}</td>
                                            <td class="">{{ $produit->rangee }}</td>
                                            <td class="">{{ getPrice($produit->price) }} </td>
                                            <td class="">{{ getPrice($produit->priceSeller) }} </td>
                                            <td class="">{{ $produit->qteStock }} </td>
                                            <td class="">{{ $produit->poids }} </td>
                                            <td class="">{{ $produit->qteMin }} </td>
                                            <td class="">{{ $produit->famille->libelle }}</td>
                                            <td class="">{{ $produit->famille->marque }}</td>
                                            <td class="">{{ $produit->famille->modele }}</td>
                                            <td class="">{{ $produit->fournisseur->nom }} </td>

                                        </tr>
                                    @endforeach

                            </tbody>
                          </table>
                          <a href="{{ route('pdf.listingProduits') }}" class="btn btn-success my-3 "><i class="icon-printer"></i>Imprimer la liste Articles</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            @foreach ($produits as $produit)
            <div class="modal fade" id="mb-delete_{{ $produit->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title login-title" id="myModalLabel">Supprimer {{ $produit->ref }} {{ $produit->designation }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            </div>
                            <div class="modal-body">
                                <p>La suppression est irréverssible!!!.
                                    Voulez-vous vraiment Supprimer cetle ligne?</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal" type="button">
                                    <i class="fa fa-reply"></i> Annuler
                                </button>

                                <form action ="{{  route('produits.destroy', $produit->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> Valider
                                    </button>
                                    <input type="hidden" name="_method" value="DELETE">

                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
@endsection
