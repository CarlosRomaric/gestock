<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
          <label for="nom" class="col-sm-3 col-form-label">Nom</label>
          <div class="col-sm-9">
            <input type="text" name="nom"  id="nom" class="form-control" value="{{ (empty($fournisseur)) ? old('nom') : $fournisseur->nom }}" placeholder="Entrez le nom du fournisseur">
            <br>
            @if (!empty($errors->has('nom')))
            <div class="alert alert-danger">
                {{ $errors->first('nom') }}
            </div>
            @endif
         </div>
        </div>



        <div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="email" name="email"  id="email" class="form-control" value="{{ (empty($fournisseur)) ? old('email') : $fournisseur->email }}" placeholder="Entrez la email du fournisseur">
            <br>
            @if (!empty($errors->has('email')))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
            @endif
         </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group row">
            <label for="contacts" class="col-sm-3 col-form-label">Contacts</label>
            <div class="col-sm-9">
                <input type="text" name="contact" maxlength="8"  id="contact" class="form-control" value="{{ (empty($fournisseur)) ? old('contact') : $fournisseur->contact }}" onkeypress="chiffres(event)" placeholder="Entrez le contact du fournisseur">
                <br>
                @if (!empty($errors->has('contact')))
                <div class="alert alert-danger">
                    {{ $errors->first('contact') }}
                </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
          <label for="domicile" class="col-sm-3 col-form-label">Localisation</label>
          <div class="col-sm-9">
            <input type="text" name="domicile"  id="domicile" class="form-control" value="{{ (empty($fournisseur)) ? old('domicile') : $fournisseur->domicile }}" placeholder="Entrez le domicile du fournisseur">
            <br>
            @if (!empty($errors->has('domicile')))
            <div class="alert alert-danger">
                {{ $errors->first('domicile') }}
            </div>
            @endif
         </div>
        </div>

        <!--<div class="form-group row">
          <label for="name" class="col-sm-3 col-form-label">Droits d'adhesion</label>
          <div class="col-sm-9">
            <input type="text" name="droitAdhesion"  id="droitAdhesion" class="form-control" value="{{ (empty($fournisseur)) ? old('droitAdhesion') : $fournisseur->droitAdhesion }}" onkeypress="chiffres(event)" placeholder="Entrez le droit d'adehsion du fournisseur">
            <br>
            @if (!empty($errors->has('droitAdhesion')))
            <div class="alert alert-danger">
                {{ $errors->first('droitAdhesion') }}
            </div>
            @endif
         </div>
         <input type="hidden" value="0" name="status">
         <input type="hidden" name="mouvement_id" value="{{ Auth::user()->mouvement_id }}">
        </div>-->

    </div>

</div>















