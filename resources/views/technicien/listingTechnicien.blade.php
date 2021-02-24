@include('inc/printerstyle')
    <h3 class="card-title text-center text-uppercase mb-5">Liste des Membres du staff</h3>

    <div class="row">
    <div class="col-12 table-responsive ">

        <table class="mt-5 table table-bordered table-hover table-sm center">
            <thead >
                <tr class="bg-dark text-white p-3 my-3">
                    <th>N°</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Prenoms</th>
                    <th class="text-center">Matricule</th>
                    <th class="text-center">Contact</th>
                    <th class="text-center">Email</th>

                </tr>
            </thead>
            <tbody>
                    <?php $i=0; ?>
                    @foreach ($techniciens as $technicien)
                    <?php $i++; ?>
                        <tr class="my-3 p-4">
                            <td>{{ $i }}</td>
                            <td class="text-center">{{ $technicien->nom }} </td>
                            <td class="text-center">{{ $technicien->prenoms }} </td>
                            <td class="text-center">{{ $technicien->matricule }} </td>
                            <td class="text-center">{{ $technicien->contacts }} </td>
                            <td class="text-center">{{ $technicien->email }} </td>

                        </tr>
                    @endforeach

            </tbody>
        </table>
    </div>
    </div>

