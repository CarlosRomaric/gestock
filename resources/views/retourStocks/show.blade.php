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
                        <h3 class="card-title text-center my-3 text-uppercase">Retour en Stock N°{{ $retourStock->id }}</h3>
                        <p class="mt-3">
                            <span class="text-uppercase"><label for=""><strong>Demandeur:  </strong> </label>{{ $retourStock->technicien->nom }} {{ $retourStock->technicien->prenoms }}</span>
                            <span class="float-right text-uppercase"><label for=""><strong>Magasinier </strong> </label>: {{ $retourStock->user->name }}</span><br>
                            <span class="text-uppercase"><label for=""><strong>Date</strong>: {{ $retourStock->created_at->format('d/m/Y') }} à {{ $retourStock->created_at->format('H:i:s') }} </label></span><br>
                        </p>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered table-hover table-sm center">
                                  <thead >
                                      <tr class="bg-secondary">
                                          <th>N°</th>

                                          <th class="text-center">image</th>
                                          <th class="text-center">Reference</th>
                                          <th class="text-center">Designation</th>
                                          <th class="text-center">Famille</th>
                                          <th class="text-center">Modele</th>
                                          <th class="text-center">Marque</th>
                                          <th class="text-center">poids (kg)</th>
                                          <th class="text-center">Prix de Vente</th>
                                          <th class="text-center">Quantité</th>
                                          <th class="text-center">Prix</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                          <?php $i=0; ?>
                                          <?php $total=0; ?>
                                          <?php $prix=0; ?>                                          <?php $tab = []; ?>
                                          @foreach ($retours as $retour)
                                          <?php $i++; ?>

                                          <?php $total +=  $retour->qteStock; ?>
                                          <?php $prix +=  ($retour->produit->priceSeller* $retour->qteStock); ?>
                                              <tr>
                                                  <td>{{ $i }}</td>
                                                  <td class="text-center"><img src="/images_produits/{{ $retour->produit->image }}" alt=""></td>
                                                  <td class="text-center">{{ $retour->produit->ref }}</td>
                                                  <td class="text-center">{{ $retour->produit->designation }}</td>
                                                  <td class="text-center">{{ $retour->produit->famille->libelle }}</td>
                                                  <td class="text-center">{{ $retour->produit->famille->modele }}</td>
                                                  <td class="text-center">{{ $retour->produit->famille->marque }}</td>
                                                  <td class="text-center">{{ $retour->poids }}</td>
                                                  <td class="text-center">{{ getPrice($retour->produit->priceSeller) }}</td>
                                                  <td class="text-center">{{ $retour->qteStock }}</td>
                                                  <td class="text-center">{{ getPrice($retour->produit->priceSeller *  $retour->qteStock) }}</td>
                                              </tr>
                                          @endforeach

                                  </tbody>
                                  <tfoot>
                                  <tr class="bg-secondary">
                                      <td colspan="9" class="text-uppercase">Total</td>
                                      <td class="text-center">{{ $total }}</td>
                                      <td class="text-center">{{ getPrice($prix) }}</td>
                                  </tr>

                                  </tfoot>
                                </table>


                                <a href="{{ route('pdf.listingRetourStocks', $retourStock->id) }}" class="btn btn-success my-3 "><i class="icon-printer"></i>Imprimer la liste du retour en Stock</a>

                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
