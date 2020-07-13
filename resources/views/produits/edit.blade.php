@extends('layouts/layouts')

@section('content')

@include('inc/menu')

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card col-md-12">
                  <div class="card-body">
                    <h4 class="card-title">Ajouter un  produit</h4>
                     @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" aria-label="Close" @click="close" id="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          {{ session('message') }}
                        </div>
                    @endif
                     @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" aria-label="Close" id="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          {{ session('danger') }}
                        </div>
                    @endif
                    <div class="row">
                      <div class="col-md-12">
                       
                        <form action="{{ route('produits.update', $produit->id) }}" method="POST" class="form-sample" enctype="multipart/form-data" >
                           @csrf
                           @method('PATCH')
                          
                           @include('produits/form')
                           <button class="btn btn-primary" type="submit">  Enregistrer </button>
                        </form>
                       
                        </div>
                    </div>
                  </div>
                </div>
              </div>
    
@endsection