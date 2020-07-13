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

                     @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show text-center col-md-4 offset-md-4">
                            <button type="button" class="close" aria-label="Close" id="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          {{ session('danger') }}
                        </div>
                    @endif
                    
                    <h3 class="card-title text-center mb-5">Liste de produits</h3>
                     <a href="{{ route('cart.index') }}" class="btn btn-primary mb-3">Panier <span class="badge badge-pill badge-light text-primary">{{ Cart::count() }}</span></a>
                    <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center" id="example2">
                            <thead >
                                   
                                <tr class=" bg-secondary">
                                    <th>N°</th>
                                    <th class="">Image</th>
                                    <th class="">Reférence</th>
                                    <th class="">Famille</th>
                                    <th class="">Fournisseur</th>
                                    <th class="">Designation</th>
                                    <th class="">Prix unitaire</th>
                                    
                                    <!--<th class="">Quantité</th>-->
                                    <th class="">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($produits as $produit)
                                    <?php $i++; ?>
                                        <tr class="text-center">
                                            <td>{{ $i }}</td>
                                            <td class=""><img src="/images_produits/{{ $produit->image }}" alt=""></td>
                                            <td class="">{{ $produit->ref }} </td>  
                                            <td class="">{{ $produit->famille->libelle }}</td>
                                            <td class="">{{ $produit->fournisseur->nom }}  {{ $produit->fournisseur->prenoms }} </td>                                         
                                            <td class="">{{ $produit->designation }} </td>                                            
                                            <td class="">{{ getPrice($produit->price) }} </td>
                                            
                                            <form action="{{ route('cart.store') }}" method="POST">

                                                @csrf
                                                <!--<td class="">
                                                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                                    <input type="text" class="form-control small" name="qteStock" size="3" onkeypress=chiffres(event)>
                                                </td>-->
                                                <td class="">
                                                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">  
                                                    @if($produit->qteStock <=0 )       
                                                    <button class="btn btn-primary btn-sm" type="submit" disabled="disabled"> Choisir </button>
                                                    @else
                                                     <button class="btn btn-primary btn-sm" type="submit"> Choisir </button>
                                                    @endif
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                               
                            </tbody>
                          </table>
                          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    

@endsection