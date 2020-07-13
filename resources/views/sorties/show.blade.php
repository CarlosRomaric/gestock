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
                    <h3 class="card-title text-center mb-5 text-uppercase">bon de sortie N°{{ $bonSortie->id }}</h3>
                    <p class="mt-3">
                    <span class="float-right text-uppercase"><label for=""><strong>Magazinier</strong> </label>: {{ $bonSortie->user->name }}</span>
                    <span class="text-uppercase"><label for=""><strong>date</strong> </label>: {{ $bonSortie->date->format('d/m/Y') }}</span><br>
                       
                        
                        <span class="text-uppercase"><label for=""><strong>Technicien</strong> </label>: {{ $bonSortie->technicien->nom }} {{ $bonSortie->technicien->prenoms }}</span>
                        
                    </p>    
                     <!--<a href="{{ route('sortie.sortieProduit') }}" class="btn btn-primary mb-3">Faire une sortie de produit</a>-->
                    <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center">
                            <thead >
                                <tr class="bg-secondary">
                                    <th>N°</th>
                                    <th class="text-center">Reference</th>
                                    <th class="text-center">Produit</th>
                                    <th class="text-center">Prix unitaire</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Prix</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=0; ?>
                                    <?php $total=0; ?>
                                    <?php $prix=0; ?>
                                    <?php $tab = []; ?>
                                    @foreach ($sorties as $sortie)
                                    <?php $i++; ?>
                                   
                                    <?php $total +=  $sortie->qteStock; ?>
                                    <?php $prix +=  $sortie->produit->price; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="text-center">{{ $sortie->produit->ref }}</td>          
                                            <td class="text-center">{{ $sortie->produit->designation }}</td>          
                                            <td class="text-center">{{ getPrice($sortie->produit->price) }}</td>          
                                            <td class="text-center">{{ $sortie->qteStock }}</td>          
                                            <td class="text-center">{{ getPrice($sortie->produit->price *  $sortie->qteStock) }}</td>          
                                        </tr>
                                    @endforeach
                               
                            </tbody>
                            <tfoot>
                            <tr class="bg-secondary">
                                <td colspan="4" class="text-uppercase">Total</td>          
                                <td class="text-center">{{ $total }}</td>
                                <td class="text-center">{{ getPrice($prix* $total) }}</td>
                            </tr>
                                
                            </tfoot>
                          </table>
                          <div class="col-md-12 my-5">
                                 
                                <form action="{{ route('sorties.update', $bonSortie->id) }}" method="POST">
                                @csrf
                                @method('patch')
                                    @if($bonSortie->status == 0)
                                        <input type="hidden" name="bon_sortie_id" value="{{ $bonSortie->id }}">
                                        @if(Auth::user()->role==0 || Auth::user()->role== 1)
                                           <button type="submit" class="btn btn-success"><i class="icon-check"></i>Valider le Bon de Sortie</button>
                                        @else
                                            <a href="#" class="btn btn-danger">En Attente de Validation</a>
                                        @endif
                                    @else
                                    <a href="{{ route('pdf.invoice', $bonSortie->id) }}" class="btn btn-success"><i class="icon-printer"></i>Imprimer le bon de sortie</a>
                                    @endif
                                </form>
                          </div>
                          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
             

         
@endsection