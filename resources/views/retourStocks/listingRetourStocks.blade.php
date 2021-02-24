

@include('inc/printerstyle')

<div class="col-md-12 offest-2 mt-5">
   <div class="card mt-10">
     <div class="card-body">

       <h3 class="card-title text-center mb-5 text-uppercase">Retour en Stock N° {{ $retourStock->id }} </h3>
       <p class="mt-3">


       <span class="text-uppercase"><label for=""><strong>Date</strong> : {{ $retourStock->created_at->format('d/m/Y') }} à {{ $retourStock->created_at->format('H:i:s') }} </label></span><br>

       <div class="row">
         <div class="col-12 table-responsive">
            <table class="table table-bordered table-hover table-sm center">
                <thead >
                    <tr class="bg-dark text-white py-3">
                        <th>N°</th>

                        <th class="text-center">image</th>
                        <th class="text-center">Reference</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Famille</th>
                        <th class="text-center">Modele</th>
                        <th class="text-center">Marque</th>
                        <th class="text-center">Poids (kg)</th>
                        <th class="text-center">Prix de Vente</th>
                        <th class="text-center">Quantité</th>
                        <th class="text-center">Prix</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $i=0; ?>
                        <?php $total=0; ?>
                        <?php $prix=0; ?>
                        <?php $tab = []; ?>
                        @foreach ($retours as $retour)
                        <?php $i++; ?>

                        <?php $total +=  $retour->qteStock; ?>
                        <?php $prix +=  ($retour->produit->priceSeller* $retour->qteStock); ?>
                            <tr class="py-3">
                                <td>{{ $i }}</td>
                                <td class="text-center"><img src="images_produits/{{ $retour->produit->image }}" alt=""></td>
                                <td class="text-center">{{ $retour->produit->ref }}</td>
                                <td class="text-center">{{ $retour->produit->designation }}</td>
                                <td class="text-center">{{ $retour->produit->famille->libelle }}</td>
                                <td class="text-center">{{ $retour->produit->famille->modele }}</td>
                                <td class="text-center">{{ $retour->produit->famille->marque }}</td>
                                <td class="text-center">{{ $retour->poids }}</td>
                                <td class="text-center">{{ getPrice($retour->produit->priceSeller) }}</td>
                                <td class="text-center">{{ $retour->qteStock }}</td>
                                <td class="text-center">{{ getPrice($retour->produit->priceSeller *  $retour->qteStock) }}</td>
                            </tr>
                        @endforeach

                </tbody>
                <tfoot>
                    <tr class="bg-dark text-white">
                        <td colspan="9" class="text-uppercase">Total</td>
                        <td class="text-center">{{ $total }}</td>
                        <td class="text-center">{{ getPrice($prix) }}</td>
                    </tr>
                </tfoot>
              </table>

         </div>

       </div>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <div class="row  bg-danger  my-5" style="position: absolute; top:90%;">
           <div class="col-md-6">
            <span class="text-uppercase"><label for=""><strong>Demandeur:</strong> {{ $retourStock->technicien->nom }} {{ $retourStock->technicien->prenoms }} </label></span>
           </div>
           <div class="col-md-6">
            <span class="text-uppercase float-right"><label for=""><strong>Magasinier </strong>: {{ $retourStock->user->name }} </label></span><br>
           </div>
       </div>

    </div>
   </div>
</div>

