<div class="form-group row">
          <label for="libelle" class="col-sm-3 col-form-label">Libelle</label>
          <div class="col-sm-9">
            <input type="text" name="libelle"  id="libelle" class="form-control" value="{{ (empty($famille)) ? old('libelle') : $famille->libelle }}" placeholder="Entrez le libelle de la famille">
            <br>
            @if (!empty($errors->has('libelle')))
            <div class="alert alert-danger">
                {{ $errors->first('libelle') }}
            </div>
            @endif
         </div>
</div>

