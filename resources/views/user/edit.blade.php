@extends('layouts/layouts')

@section('content')
@include('inc/menu')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card col-md-8 offset-md-2">
                  <div class="card-body">
                    <h4 class="card-title">Modifier un utilisateur</h4>
                       
                    <a href="{{ route('user.index') }}" class="btn btn-primary my-3">Liste des utilisateurs</a>
                    <div class="row">
                        

                      <div class="col-md-12">
                       
                        <form action="{{ route('user.update', $user->id) }}" method="POST" class="form-sample" >
                         @csrf
                           @include('user/form')
                           <input type="hidden" name="_method" value="PATCH">
                           <button class="btn btn-primary" type="submit"> Enregistrer </button>
                        </form>
                           
                       
                        </div>
                    </div>
                  </div>
                </div>
              </div>
    
@endsection