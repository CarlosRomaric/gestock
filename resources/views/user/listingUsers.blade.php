@include('inc/printerstyle')



   <div class="col-md-12 offest-2 mt-5">
      <div class="card mt-10">
        <div class="card-body">

          <h3 class="card-title text-center mb-5 text-uppercase">Liste des Utlisateurs</h3>


          <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-hover table-sm center" id="example2">
                    <thead >
                        <tr class="bg-dark text-white  p-5">
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @foreach ($users as $user)
                        <?php $i++; ?>
                            <tr class="p-5">
                                <td>{{ $i }}</td>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->contacts }} </td>
                                <td>
                                <?php
                                    switch ($user->role) {
                                    case 0:
                                        echo "Admin";
                                        break;
                                    case 1:
                                        echo "Responsable";
                                        break;
                                        case 2:
                                        echo "Superviseur";
                                        break;
                                        case 3:
                                        echo "Utilisateur";
                                        break;
                                    }?>
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




