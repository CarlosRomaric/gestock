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
                    <h3 class="card-title text-center mb-5">Liste des Membres du staff</h3>
                    @if(Auth::user()->role==0)
                     <a href="{{ route('technicien.create') }}" class="btn btn-primary mb-3">Ajouter un membre du staff</a>
                    @endif
                    <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center" id="example2">
                            <thead >
                                <tr class="bg-secondary">
                                    <th>N°</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prenoms</th>
                                    <th class="text-center">Matricule</th>
                                    <th class="text-center">Contact</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($techniciens as $technicien)
                                    <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="text-center">{{ $technicien->nom }} </td>
                                            <td class="text-center">{{ $technicien->prenoms }} </td>
                                            <td class="text-center">{{ $technicien->matricule }} </td>
                                            <td class="text-center">{{ $technicien->contacts }} </td>
                                            <td class="text-center">{{ $technicien->email }} </td>
                                            <td class="text-center">

                                                <a class="btn btn-primary btn-sm" href="/technicien/{{ $technicien->id }}/edit" title="modifié les info du membre">
                                                    <i class="icon-note"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mb-delete_{{ $technicien->id }}"><i class=" icon-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                            </tbody>
                          </table>
                      </div>
                    </div>
                    <a href="{{ route('pdf.listingTechnicien') }}" class="btn btn-success my-3"><i class="icon-printer"></i>Imprimer la liste des membres du staff</a>
                  </div>
                </div>
              </div>



            @foreach ($techniciens as $technicien)
            <div class="modal fade" id="mb-delete_{{ $technicien->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title login-title" id="myModalLabel">Supprimer {{ $technicien->nom }} {{ $technicien->prenoms }}</h4>
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

                                <form action ="{{  route('technicien.destroy', $technicien->id) }}" method="POST">
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
