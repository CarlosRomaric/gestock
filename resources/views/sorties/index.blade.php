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
                    <h3 class="card-title text-center text-uppercase mb-5">Liste des bon de sorties</h3>
                    @if(Auth::user()->role==0)
                     <a href="{{ route('sortie.sortieProduit') }}" class="btn btn-primary mb-3">Faire une sortie de produit</a>
                    @endif
                     <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center" id="example2">
                            <thead >
                                <tr class="bg-secondary">
                                    <th>N°</th>
                                    <th class="text-center">Technicien</th>
                                    <th class="text-center">Utlisateur</th>
                                    {{-- <th class="text-center">Superviseur</th> --}}
                                    <th class="text-center">Numero OT</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @foreach ($sorties as $sortie)

                                        <tr>
                                            <td>{{ $sortie->id }}</td>
                                            <td class="text-center">{{ $sortie->technicien->nom }} {{ $sortie->technicien->prenoms }}</td>
                                            <td class="text-center text-uppercase">{{ $sortie->user->name }}  </td>
                                            {{-- <td class="text-center text-uppercase">{{ $sortie->sperviseur }}  </td> --}}
                                            <td class="text-center text-uppercase">{{ $sortie->numberOT }}  </td>

                                            <td class="text-center">{{ $sortie->date->format('d/m/Y') }} </td>
                                            <td class="text-center">
                                                <!--<a href="#" class="btn btn-sm btn-warning"> <i class="icon-eye"></i> </a>-->
                                                <?php
                                                switch ($sortie->status) {
                                                case 0:
                                                    echo '<button class="btn badge badge-warning btn-sm">en attente </button>';
                                                    break;
                                                case 1:
                                                    echo '<button class="btn badge badge-success btn-sm">Validé </button>';
                                                    break;
                                                 case 2:
                                                    echo '<button class="btn badge badge-danger btn-sm">Rejeter </button>';
                                                    break;
                                               }?>
                                                {{-- @if(($sortie->status == 0) )
                                                    <button class="btn badge badge-danger btn-sm">en attente </button>
                                                @else
                                                     <button class="btn badge badge-success btn-sm">Validé </button>
                                                @endif --}}
                                            </td>
                                            <td class="text-center">
                                                    <a href="sorties/{{ $sortie->id }}" class="btn btn-warning" title="Voir les détails du bon de sortie"><i class="icon-eye"></i></a>
                                            </td>
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
