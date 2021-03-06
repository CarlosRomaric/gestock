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

                    <h3 class="card-title text-center mb-5">Liste des Familles de produits</h3>
                    @if(Auth::user()->role == 0)
                     <a href="{{ route('famille.create') }}" class="btn btn-primary mb-3">Ajouter un famille de Produit</a>
                    @endif
                     <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center" id="example2">
                            <thead >
                                <tr class="bg-secondary">
                                    <th>N°</th>
                                    <th class="text-center">Libellé</th>
                                    <th class="text-center">Marque</th>
                                    <th class="text-center">Modele</th>
                                    @if(Auth::user()->role==0)
                                    <th class="text-center">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($familles as $famille)
                                    <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="text-center text-uppercase">{{ $famille->libelle }} </td>
                                            <td class="text-center text-uppercase">{{ $famille->marque }} </td>
                                            <td class="text-center text-uppercase">{{ $famille->modele }} </td>
                                            @if(Auth::user()->role==0)
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="/famille/{{ $famille->id }}/edit" title="modifié les info du membre">
                                                    <i class="icon-note"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mb-delete_{{ $famille->id }}"><i class=" icon-trash"></i></button>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach

                            </tbody>
                          </table>
                          <a href="{{ route('pdf.listingFamilles') }}" class="btn btn-success my-3"><i class="icon-printer"></i>Imprimer la liste des Familles</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            @foreach ($familles as $famille)
            <div class="modal fade" id="mb-delete_{{ $famille->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title login-title" id="myModalLabel">Supprimer {{ $famille->name }} {{ $famille->prenoms }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            </div>
                            <div class="modal-body">
                                <p>La suppression est irréverssible!!!.
                                    Voulez-vous vraiment Supprimer cetle ligne?</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal" type="button">
                                    <i class="fa fa-reply"></i> Annuler
                                </button>

                                <form action ="{{  route('famille.destroy', $famille->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> Valider
                                    </button>
                                    <input type="hidden" name="_method" value="DELETE">

                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
@endsection
