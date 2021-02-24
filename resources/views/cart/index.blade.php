@extends('layouts/layouts')

@section('content')
@include('inc/menu')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card col-md-12 ">
                  <div class="card-body">
                    <h4 class="card-title">Panier</h4>
                     @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" aria-label="Close" id="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('cart.videpanier') }}" class="btn btn-primary my-3">Vider le Panier</a>
                    <button class="btn btn-primary float-right mb-3">Panier <span class="badge badge-pill badge-light text-primary">{{ Cart::count() }}</span></button>
                    <div class="row">

                         <div class="table-responsive">
                            @if(Cart::count()>0):
                            <table class="table"  id="example2">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th>Article</th>
                                        <th>Prix</th>
                                        <th width="10%">Quantité</th>
                                        <th>Sous Total </th>
                                        <th class="text-center" >Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Cart::content() as $product)
                                        <tr>
                                            <th scope="row">
                                                <div class="py-2">
                                                    <img src="images_produits/{{ $product->model->image }}" alt="" class="img-fluid img-responsive rounded shadow-sm" width="400 px">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0">
                                                            <a href="" class="text-dark d-inline-block align-middle">
                                                                {{ $product->model->title }}
                                                            </a>
                                                        </h5>
                                                        <span class="text-muted font-weight-normal font-italic d-block">Categorie: {{ $product->model->famille->libelle }} </span>
                                                    </div>
                                                </div>

                                            </th>
                                            <td width="10%"> {{ getPrice($product->model->priceSeller) }} </td>
                                            <!--<td> <input type="text" size="2" id="" class="form-control" value="{{ $product->qty }}"> </td>-->
                                            <td>
                                                <select name="qty"   id="qty" data-id="{{ $product->rowId }}" class=" form-control custom-select">
                                                     @for($i = 1; $i <= $product->model->getQteStockById($product->id); $i++ )
                                                        <option value="{{ $i }}" {{ $i == $product->qty ? 'selected' : '' }}>{{ $i }}</option>
                                                     @endfor

                                                </select>
                                            </td>
                                            <td> {{ getPrice($product->model->priceSeller * $product->qty) }} </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-secondary ">
                                        <th  colspan="3">Prix Hors Taxe Total</th>
                                        <th>{{ Cart::subtotal() }} </th>
                                        <th class="text-center" >Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                             <div class="col-md-12 mt-4">
                                <div class="shadow bg-dark text-white py-4 text-center circle text-uppercase form-control">
                                    <Strong><h3></h3></Strong>
                                </div>
                                <div class="mt-3 py-2">
                                    <form action="{{ route('sorties.store') }}" method="POST">
                                         @csrf
                                         @include('sorties/form')
                                         <button class=" col-md-4 offset-md-4 btn btn-lg btn-block btn-dark mt-4 circle arrow " type="submit">
                                            Envoyez pour Validation
                                         </button>
                                    </form>

                                </div>
                             </div>

                            @else
                            <div class="row">
                                <div class="col-md-5 text-center">
                                     <img src="/assets/images/images.png" width="50%" alt="oops le panier est vide">
                                </div>
                                <div class="col-md-5 text-center">
                                    <a  href="{{ route('sortie.sortieProduit') }}" class="btn btn-primary btn-lg">Retour sur la page des articles</a>
                                </div>
                            </div>

                            @endif
                         </div>
                    </div>
                  </div>
                </div>
              </div>

@endsection
