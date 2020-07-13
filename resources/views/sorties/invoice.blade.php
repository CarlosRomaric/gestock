@include('inc/printerstyle')


   <br>
   <br>
   <br>
   <br>
   <br>  
   <div class="col-md-10 offest-2">
      <div class="card mt-10">
        <div class="card-body">
          
          <h3 class="card-title text-center mb-5 text-uppercase">bon de sortie N°{{ $bonSortie->id }}</h3>
          <p class="mt-3">
          <span class="float-right text-uppercase"><label for=""><strong>Magazinier</strong> : {{ $bonSortie->user->name }}</label></span>
          <span class="text-uppercase"><label for=""><strong>Date</strong>: {{ $bonSortie->date->format('d/m/Y') }} </label></span><br>
              
              
              <span class="text-uppercase"><label for=""><strong>Technicien</strong> : {{ $bonSortie->technicien->nom }} {{ $bonSortie->technicien->prenoms }}</label></span>
              
          </p>    
            <!--<a href="{{ route('sortie.sortieProduit') }}" class="btn btn-primary mb-3">Faire une sortie de produit</a>-->
          <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-hover center">
                  <thead >
                      <tr class="bg-dark text-white my-3">
                          <th class="text-center">N°</th>
                          <th class="text-center">Référence</th>
                          <th class="text-center">Produit</th>
                          <th class="text-center">Prix Unitaire</th>
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
                              <tr class="my-3">
                                  <td class="text-center">{{ $i }}</td>
                                  <td class="text-center">{{ $sortie->produit->ref }}</td>          
                                  <td class="text-center">{{ $sortie->produit->designation }}</td>          
                                  <td class="text-center">{{ getPrice($sortie->produit->price) }}</td>          
                                  <td class="text-center">{{ $sortie->qteStock }}</td>          
                                  <td class="text-center">{{ getPrice($sortie->produit->price * $sortie->qteStock) }}</td>          
                              </tr>
                          @endforeach
                      
                  </tbody>
                  <tfoot>
                  <tr class="bg-dark text-white my-3">
                      <td colspan="4" class="text-uppercase">Total</td>          
                      <td class="text-center">{{ $total }}</td>
                      <td class="text-center">{{ getPrice($prix * $total) }}</td>
                  </tr>
                      
                  </tfoot>
                </table>
                
                
            </div>
          </div>
        </div>
      </div>
   </div>    
  
           
             

