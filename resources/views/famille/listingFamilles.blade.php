@include('inc/printerstyle')



   <div class="col-md-12 offest-2 mt-5">
      <div class="card mt-10">
        <div class="card-body">

          <h3 class="card-title text-center mb-5 text-uppercase">Liste des Familles d'Articles</h3>


          <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-hover table-sm center" id="example2">
                    <thead >
                        <tr class="bg-dark text-white p-5">
                            <th>N°</th>
                            <th class="text-center">Libellé</th>
                            <th class="text-center">Marque</th>
                            <th class="text-center">Modele</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @foreach ($familles as $famille)
                        <?php $i++; ?>
                            <tr class="p-5">
                                <td>{{ $i }}</td>
                                <td class="text-center text-uppercase">{{ $famille->libelle }} </td>
                                <td class="text-center text-uppercase">{{ $famille->marque }} </td>
                                <td class="text-center text-uppercase">{{ $famille->modele }} </td>
                            </tr>
                        @endforeach

                    </tbody>
                  </table>

            </div>
          </div>
        </div>
      </div>
   </div>




