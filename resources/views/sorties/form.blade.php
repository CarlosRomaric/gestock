<div class="form-group row">
    <label for="" id="" class="col-sm-3">Numero OT</label>
    <div class="col-sm-9">
        <input type="text"  class="form-control" name="numberOT" placeholder="Entrez le numero OT">
    </div>
</div>

<div class="form-group row">
    <label for="technicien_id" class="col-sm-3 col-form-label">Nom de l'Utilisateur</label>
    <div class="col-sm-9">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="date" value="{{ date('Y-m-d H:i:s') }}">
        <select name="technicien_id"  class="js-example-basic-single w-100 " id="">
                    <option value="">Selectionner l'utilisateur</option>
                    @foreach($techniciens as $key=> $technicien)
                        <option value="{{ $key }}" >{{ $technicien }}</option>
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

<div class="form-group row">
    <label for="superviseur_id" class="col-sm-3 col-form-label">Nom du Validateur</label>
    <div class="col-sm-9">
        {{-- <input type="hidden" name="superviseur_id" value="{{ Auth::user()->id }}"> --}}
        <input type="hidden" name="date" value="{{ date('Y-m-d H:i:s') }}">
        <select name="superviseur_id"  class="js-example-basic-single w-100 " id="">
                    <option value="">Selectionnez le validateur</option>
                      @foreach($superviseurs as $superviseur)
                        <option value="{{ $superviseur->id }}">{{ $superviseur->name }}</option>
                      @endforeach
        </select>
        <br>
        @if (!empty($errors->has('supervisuer_id')))
        <div class="alert alert-danger mt-4">
            {{ $errors->first('superviseur_id') }}
        </div>
        @endif
    </div>
</div>


