<div class="row">
    <div class="col-md-12">

        <div class="form-group row">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <label for="technicien_id" class="col-sm-3 col-form-label">Membre du Staff</label>
            <div class="col-sm-9">
              <select name="technicien_id"  class="js-example-basic-single w-100" id="">
                  <option value="">Choisissez le membre du staff retournant le produit </option>
                  @foreach($techniciens as $key => $technicien)
                      <option value="{{ $key }}" class="text-uppaercase"  {{-- (selected==$key)?"selected":'' --}}  ><label for="" class="text-uppercase">{{ $technicien }}</label></option>
                  @endforeach
              </select>
              <br>
              @if (!empty($errors->has('technicien_id')))
              <div class="alert alert-danger mt-4">
                  {{ $errors->first('technicien_id') }}
              </div>
              @endif
            </div>
        </div>

        <div class=" form-group  table-responsive">
            <label for="" class="label-form-group">Liste des Produits en Stocks</label>
            <table class="table table-bordered" id="example2">
                <thead>
                    <tr>
                        <th>Reférence</th>
                        <th>Image</th>
                        <th>Designation</th>
                        <th>Stock</th>
                        <th>Cocher les produit pour le retour</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                    <tr>
                        <td>{{ $produit->ref }}</td>
                        <td> <img src="/images_produits/{{ $produit->image }}" alt=""></td>
                        <td>{{ $produit->designation }}</td>
                        <td>{{ $produit->qteStock }}</td>
                        <td scope="rows">
                            <div class="form-group row">
                                <div class="col-sm-1">
                                    <input type="checkbox" class="" name="produit_id[]" value="{{ $produit->id }}">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" name="qteStock[{{ $produit->id }}]" onkeypress="chiffres(event)" class="  form-control" placeholder="Entrez la quantité rétourné">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="poids[{{ $produit->id }}]" onkeypress="chiffres(event)" class="  form-control" placeholder="Entrez le poids du produit">
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

</div>















