@extends('layouts/layouts')

@section('content')
@include('inc/menu')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card col-md-12 ">
                  <div class="card-body">
                    <h4 class="card-title">Mise à jour d'un Technicien </h4>
                       
                    <a href="{{ route('technicien.index') }}" class="btn btn-primary my-3">Liste des Techniciens de produits</a>
                    <div class="row">
                        

                      <div class="col-md-12">
                       
                        <form action="{{ route('technicien.update', $technicien->id) }}" method="POST" class="form-sample" >
                         @csrf
                           @include('technicien/form')
                           <input type="hidden" name="_method" value="PATCH">
                           <button class="btn btn-primary">Valider</button>
                        </form>
                           
                       
                        </div>
                    </div>
                  </div>
                </div>
              </div>
    
@endsection