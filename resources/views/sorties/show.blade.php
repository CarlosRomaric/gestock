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
                    <h3 class="card-title text-center mb-5 text-uppercase">bon de sortie N°{{ $bonSortie->id }}</h3>
                    <p class="mt-3">
                    <span class="float-right text-uppercase"><label for=""><strong>Utilisateur</strong> </label>: {{ $bonSortie->user->name }}</span><br>
                    {{-- <span class="float-right text-uppercase"><label for=""><strong>Numéro OT</strong> </label>: {{ $bonSortie->numberOT }} </span> --}}
                    <span class="text-uppercase"><label for=""><strong>date</strong> </label>: {{ $bonSortie->date->format('d/m/Y') }}</span><br>


                        <span class="text-uppercase"><label for=""><strong>Technicien</strong> </label>: {{ $bonSortie->technicien->nom }} {{ $bonSortie->technicien->prenoms }}</span>
                        <span class="float-right text-uppercase"><label for=""><strong>Superviseur</strong> </label>: {{ $bonSortie->superviseur->name }}</span><br>

                    </p>
                     <!--<a href="{{ route('sortie.sortieProduit') }}" class="btn btn-primary mb-3">Faire une sortie de produit</a>-->
                    <div class="row">
                      <div class="col-12 table-responsive">
                          <table class="table table-bordered table-hover table-sm center">
                            <thead >
                                <tr class="bg-secondary">
                                    <th>N°</th>

                                    <th class="text-center">Reference</th>
                                    <th class="text-center">Article</th>
                                    <th class="text-center">Famille</th>
                                    <th class="text-center">Modele</th>
                                    <th class="text-center">Prix unitaire</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=0; ?>
                                    <?php $total=0; ?>
                                    <?php $prix=0; ?>
                                    <?php $tab = []; ?>
                                    @foreach ($sorties as $sortie)
                                    <?php $i++; ?>

                                    <?php $total +=  $sortie->qteStock; ?>
                                    <?php $prix +=  ($sortie->produit->price* $sortie->qteStock); ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="text-center">{{ $sortie->produit->ref }}</td>
                                            <td class="text-center">{{ $sortie->produit->designation }}</td>
                                            <td class="text-center">{{ $sortie->produit->famille->libelle }}</td>
                                            <td class="text-center">{{ $sortie->produit->famille->modele }}</td>
                                            <td class="text-center">{{ getPrice($sortie->produit->price) }}</td>
                                            <td class="text-center">{{ $sortie->qteStock }}</td>
                                            <td class="text-center">{{ getPrice($sortie->produit->price *  $sortie->qteStock) }}</td>
                                        </tr>
                                    @endforeach

                            </tbody>
                            <tfoot>
                            <tr class="bg-secondary">
                                <td colspan="6" class="text-uppercase">Total</td>
                                <td class="text-center">{{ $total }}</td>
                                <td class="text-center">{{ getPrice($prix) }}</td>
                            </tr>

                            </tfoot>
                          </table>
                          <div class="col-md-12 my-5">

                                <?php switch ($bonSortie->status) {
                                    case '0': ?>
                                        @if(Auth::user()->role==0 || Auth::user()->role== 1 || Auth::user()->role== 2)

                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#mb-update">Valider le Bon de Sortie <i class="icon-check"></i></button>
                                        @else
                                            <a href="#" class="btn btn-danger">En Attente de Validation</a>
                                        @endif

                                     <?php   break; ?>

                                     <?php case '1'?>
                                        <a href="{{ route('pdf.invoice', $bonSortie->id) }}" class="btn btn-success"><i class="icon-printer"></i>Imprimer le bon de sortie</a>
                                     <?php break;?>

                                    <?php case '2': ?>
                                        @if(Auth::user()->role==0 || Auth::user()->role== 1 || Auth::user()->role== 2)

                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#mb-update">Valider le Bon de Sortie <i class="icon-check"></i></button>
                                        @else
                                            <a href="#" class="btn btn-danger">En Attente de Validation</a>
                                        @endif
                                    <?php break;
                                 }?>
                                    @if($bonSortie->status == 0)


                                    @else

                                    @endif

                          </div>

                          <div class="modal fade" id="mb-update" tabindex="-1" role="dialog" aria-labelledby="updateLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action ="{{ route('sorties.update', $bonSortie->id) }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="modal-header">
                                            <h4 class="modal-title login-title" id="myModalLabel">Validation du Bon de Sortie</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <input type="hidden" name="bon_sortie_id" value="{{ $bonSortie->id }}"> --}}
                                            <div class="form-group row">
                                                <label for="" class="col col-sm-4">Remarque</label>
                                                <div class="col-sm-8">
                                                    <textarea name="remarque" class="form-control" id="" cols="30" rows="10" placeholder="Indiquer votre Remarque" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="submit" name="status" value="2">
                                                <i class="fa fa-reply"></i> Rejeter
                                            </button>

                                            <button type="submit" name="status" value="1" class="btn btn-success">
                                                <i class="fa fa-save"></i> Valider
                                            </button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                          </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>




@endsection
