@include('inc/printerstyle')



   <div class="mt-5">
      <div class="card mt-10">
        <div class="card-body">

          <h3 class="card-title text-center mb-5 text-uppercase">Liste des Articles</h3>


          <div class="row">
            <div class="table-responsive">
                <table class="table  table-bordered table-hover center">
                    <thead >

                        <tr class=" bg-dark text-white text-small px-4">
                            <th>N°</th>
                            <th class="">Image</th>
                            <th class="">Reférence</th>
                            <th class="">N°Bon de Cmd</th>
                            <th class="">Designation</th>
                            <th class="">Famille</th>
                            <th class="">Localisation</th>
                            <th class="">Prix Achat</th>
                            <th class="">Prix de vente</th>
                            <th class="">Stock</th>

                        </tr>
                    </thead>
                    <tbody>
                            <?php $i=0; ?>
                            @foreach ($produits as $produit)
                            <?php $i++; ?>
                                <tr class="px-4 text-center">
                                    <td>{{ $i }}</td>
                                    <td class="px-5"> <img src="images_produits/{{ $produit->image }}" alt="{{ $produit->designation }}"> </td>
                                    <td class="px-5">{{ $produit->ref }} </td>
                                    <td class="px-5">{{ $produit->numBonCommande }} </td>
                                    <td class="px-5">{{ $produit->designation }} </td>
                                    <td class="px-5"><?php echo $produit->famille->libelle.'<br>'.$produit->famille->modele.'<br>'.$produit->famille->marque ?></td>
                                    <td class="px-5">
                                       Magasin: {{ $produit->magasin }}<br>
                                       Etagère: {{ $produit->etagere }}<br>
                                       Rangée:  {{ $produit->rangee }}
                                    </td>

                                    <td class="px-5">{{ getPrice($produit->price) }} </td>
                                    <td class="px-5">{{ getPrice($produit->priceSeller) }} </td>
                                    <td class="px-5">{{ $produit->qteStock }} </td>



                                </tr>
                            @endforeach

                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
   </div>




