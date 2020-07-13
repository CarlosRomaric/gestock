<div class="form-group row">
          <label for="qteStock" class="col-sm-3 col-form-label">Quantité</label>
          <div class="col-sm-9">
            <input type="text" name="qteStock"  id="qteStock" class="form-control" value="" placeholder="Entrez le Quantité du produit" onkeypress="chiffres(event)">
            <br>
            @if (!empty($errors->has('qteStock')))
            <div class="alert alert-danger">
                {{ $errors->first('qteStock') }}
            </div>
            @endif
         </div>
</div>

<input type="hidden" name="produit_id" value="{{ $produit->id }}">
<input type="hidden" name="user_id" value = "{{ Auth::user()->id }}">
<input type="hidden" name="date" value = "{{ date('Y-m-d H:i:s') }}">
