@extends('layouts/layouts')

@section('content')

@include('inc/menu')

<div class="container-scroller">
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-dark text-white border-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <i class="icon-briefcase icon-lg"></i>
                    <div class="ml-4">
                      <h4 class="font-weight-light">Stock totale de Produits</h4>
                      <h3 class="font-weight-light mb-3"> {{ $stock_produits }}</h3>
                      <!--<p class="mb-0 font-weight-light">39% more growth </p>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-success text-white border-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <i class="icon-user icon-lg"></i>
                    <div class="ml-4">
                      <h4 class="font-weight-light">Utilisateurs</h4>
                      <h3 class="font-weight-light mb-3">{{ $nbre_users }}</h3>
                      <!--<p class="mb-0 font-weight-light">43% more this year </p>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-danger text-white border-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <i class="icon-people icon-lg"></i>
                    <div class="ml-4">
                      <h4 class="font-weight-light">Staff</h4>
                      <h3 class="font-weight-light mb-3">{{ $nbre_Technicien }}</h3>
                      <!--<p class="mb-0 font-weight-light">69% increase</p>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card bg-primary text-white border-0">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <i class=" icon-calendar icon-lg"></i>
                      <div class="ml-4">
                       
                        <h4 class="font-weight-light"><?= ucfirst(utf8_encode(strftime('%A', strtotime(date('d-m-Y'))))); ?></h4>
                        <h3 class="font-weight-light mb-3"><?= ucfirst(utf8_encode(strftime(' %d %B', strtotime(date('d-m-Y'))))); ?></h3>
                        <p class="mb-0 font-weight-light"><?= ucfirst(utf8_encode(strftime(' %Y ', strtotime(date('d-m-Y'))))); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
             </div>
            </div>

            <div class="card my-4">
              <div class="card-body">
                <h4 class="card-title">Bienvenue dans votre Espace d'administration   {{ Auth::user()->name }}   </h4>
                
                <div class="row">
                  <div class="col-12 table-responsive">
                   
                  </div>
                </div>
              </div>
            </div>
         
        </div>
      

  @endsection