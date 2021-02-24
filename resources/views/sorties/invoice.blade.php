@include('inc/printerstyle')



   <div class="col-md-12 offest-2 mt-5">
      <div class="card mt-10">
        <div class="card-body">

          <h3 class="card-title text-center mb-5 text-uppercase">bon de sortie N°{{ $bonSortie->id }}</h3>
          <p class="mt-3">
            <span class="float-right text-uppercase"><label for=""><strong>Utilisateur</strong> </label>: {{ $bonSortie->user->name }}</span><br>
          <span class="text-uppercase"><label for=""><strong>Date</strong>: {{ $bonSortie->date->format('d/m/Y') }} </label></span><br>


          <span class="text-uppercase"><label for=""><strong>Technicien</strong> </label>: {{ $bonSortie->technicien->nom }} {{ $bonSortie->technicien->prenoms }}</span>
          <span class="float-right text-uppercase"><label for=""><strong>Superviseur</strong> </label>: {{ $bonSortie->superviseur->name }}</span><br>

          </p>
            <!--<a href="{{ route('sortie.sortieProduit') }}" class="btn btn-primary mb-3">Faire une sortie de produit</a>-->
          <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-hover center">
                  <thead >
                      <tr class="bg-dark text-white my-3 mx-3">
                        <th>N°</th>
                        <th class="text-center">Reference</th>
                        <th class="text-center">Article</th>
                        <th class="text-center">Famille</th>
                        <th class="text-center">Modele</th>
                        <th class="text-center">Prix Achat</th>
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
                          <?php $prix +=  $sortie->produit->price; ?>
                              <tr class="my-3 x-3">
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
                  <tr class="bg-dark text-white my-3">
                      <td colspan="6" class="text-uppercase">Total</td>
                      <td class="text-center">{{ $total }}</td>
                      <td class="text-center">{{ getPrice($prix) }}</td>
                  </tr>

                  </tfoot>
                </table>


            </div>
          </div>
        </div>
      </div>
   </div>




