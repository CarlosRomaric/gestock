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

<div class="form-group row">
    <label for="marque" class="col-sm-3 col-form-label">Marque</label>
    <div class="col-sm-9">
      <input type="text" name="marque"  id="marque" class="form-control" value="{{ (empty($famille)) ? old('libelle') : $famille->marque }}" placeholder="Entrez le libelle de la famille">
      <br>
      @if (!empty($errors->has('marque')))
      <div class="alert alert-danger">
          {{ $errors->first('marque') }}
      </div>
      @endif
   </div>
</div>


<div class="form-group row">
    <label for="modele" class="col-sm-3 col-form-label">Modele</label>
    <div class="col-sm-9">
      <input type="text" name="modele"  id="modele" class="form-control" value="{{ (empty($famille)) ? old('modele') : $famille->modele }}" placeholder="Entrez le modele de la famille">
      <br>
      @if (!empty($errors->has('modele')))
      <div class="alert alert-danger">
          {{ $errors->first('modele') }}
      </div>
      @endif
   </div>
</div>

