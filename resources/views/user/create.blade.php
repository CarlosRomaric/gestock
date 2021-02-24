@extends('layouts/layouts')

@section('content')

@include('inc/menu')

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card col-md-8 offset-md-2">
                  <div class="card-body">
                    <h4 class="card-title">Ajout  d'un utilisateur</h4>
                    <div class="row">
                      <div class="col-md-12">
                        <a href="{{ route('user.index') }}" class="btn btn-primary mb-3">Liste des Utilisateurs</a>
                        @if (session('danger'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" aria-label="Close" @click="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            {{ session('danger') }}
                            </div>
                         @endif
                          <form action="{{ route('user.store') }}" method="POST" class="form-sample" >
                            @csrf
                            @include('user/form')
                            <button class="btn btn-primary" type="submit"> Enregistrer </button>
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

@endsection
