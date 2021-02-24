@include('inc/printerstyle')



   <div class="col-md-12 offest-2 mt-5">
      <div class="card mt-10">
        <div class="card-body">

          <h3 class="card-title text-center mb-5 text-uppercase">Liste des Fournisseurs</h3>


          <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-hover table-sm center" id="example2">
                    <thead >
                        <tr class="bg-dark text-white">
                            <th>N°</th>
                            <th class="text-center">Nom & Prénoms</th>
                            <th class="text-center">Contact</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Domicile</th>

                        </tr>
                    </thead>
                    <tbody>
                            <?php $i=0; ?>
                            @foreach ($fournisseurs as $fournisseur)
                            <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="text-center">{{ $fournisseur->nom }} </td>
                                    <td class="text-center">{{ $fournisseur->contact }} </td>
                                    <td class="text-center">{{ $fournisseur->email }} </td>
                                    <td class="text-center">{{ $fournisseur->domicile }} </td>
                                </tr>
                            @endforeach

                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
   </div>




