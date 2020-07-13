@extends('layouts/layouts')

@section('content')
@include('inc/menu')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card col-md-12 ">
                  <div class="card-body">
                    <h4 class="card-title">Mise à jour d'un Fournisseur de produit</h4>
                       
                    <a href="{{ route('fournisseur.index') }}" class="btn btn-primary my-3">Liste des Fournisseurs de produits</a>
                    <div class="row">
                        

                      <div class="col-md-12">
                       
                        <form action="{{ route('fournisseur.update', $fournisseur->id) }}" method="POST" class="form-sample" >
                         @csrf
                           @include('fournisseur/form')
                           <input type="hidden" name="_method" value="PATCH">
                           <button class="btn btn-primary">Valider</button>
                        </form>
                           
                       
                        </div>
                    </div>
                  </div>
                </div>
              </div>
    
@endsection