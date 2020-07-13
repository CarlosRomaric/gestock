@extends('layouts/layouts')

@section('content')

@include('inc/menu')
 <a href="{{ route('famille.index') }}" class="btn btn-primary mb-5"> <i class="fa fa-arrow-circle-left"></i> Retour</a>
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card col-md-12">
                  <div class="card-body">
                    <a href="{{ route('famille.index') }}" class="btn btn-primary mb-5"> <i class="fa fa-arrow-circle-left"></i> Retour</a>
                    <h4 class="card-title">Ajouter une Famille de produit</h4>
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
                       
                        <form action="{{ route('famille.store') }}" method="POST" class="form-sample" >
                           @csrf
                           @include('famille/form')
                           <button class="btn btn-primary" type="submit">  Enregistrer </button>
                        </form>
                       
                        </div>
                    </div>
                  </div>
                </div>
              </div>
    
@endsection