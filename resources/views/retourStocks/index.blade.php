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
                    <h3 class="card-title text-center text-uppercase mb-5">Liste des Retours d'Articles en stocks</h3>
                    @if(Auth::user()->role==0)
                     <a href="{{ route('retourStocks.create') }}" class="btn btn-primary mb-3">Enregistrer un retour d'article en stock</a>
                    @endif
                     <div class="row">
                      <div class="col-12 table-responsive">

                          <table class="table table-bordered table-hover table-sm center" id="example2">
                            <thead >
                                <tr class="bg-secondary">
                                    <th>N°</th>
                                    <th class="text-center">Membre du Staff</th>
                                    <th class="text-center">Agent Receptionneur</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @foreach ($retourStocks as $retourStock)

                                        <tr>
                                            <td>{{ $retourStock->id }}</td>
                                            <td class="text-center">{{ $retourStock->technicien->nom }} {{ $retourStock->technicien->prenoms }}</td>
                                            <td class="text-center text-uppercase">{{ $retourStock->user->name }}  </td>
                                            <td class="text-center">{{ $retourStock->created_at->format('d/m/Y') }} </td>
                                            <td class="text-center">
                                                    <a href="retourStocks/{{ $retourStock->id }}" class="btn btn-warning" title="Voir les détails du retour en stock"><i class="icon-eye"></i></a>
                                                    <a href="{{ route('pdf.listingRetourStocks', $retourStock->id) }}" title="Imprimer la liste du retour en Stock" class="btn btn-success"><i class="icon-printer"></i></a>
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
