<div class="row">

    <div class="col-md-6">


        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Matricule</label>
            <div class="col-sm-9">
              <input type="text" name="matricule"  id="matricule" class="form-control" value="{{ (empty($user)) ? old('name') : $user->name }}" placeholder="Entrez le matricule de l'utilisateur">
              <br>
              @if (!empty($errors->has('matriculee')))
              <div class="alert alert-danger">
                  {{ $errors->first('matricule') }}
              </div>
              @endif
           </div>
        </div>

        <div class="form-group row">
          <label for="nom" class="col-sm-3 col-form-label">Nom</label>
          <div class="col-sm-9">
            <input type="text" name="nom"  id="nom" class="form-control" value="{{ (empty($technicien)) ? old('nom') : $technicien->nom }}" placeholder="Entrez le nom du technicien">
            <br>
            @if (!empty($errors->has('nom')))
            <div class="alert alert-danger">
                {{ $errors->first('nom') }}
            </div>
            @endif
         </div>
        </div>

        <div class="form-group row">
            <label for="prenoms" class="col-sm-3 col-form-label">Prenoms</label>
            <div class="col-sm-9">
                <input type="text" name="prenoms"  id="prenoms" class="form-control" value="{{ (empty($technicien)) ? old('prenoms') : $technicien->prenoms }}" placeholder="Entrez le prenom du technicien">
                <br>
                @if (!empty($errors->has('prenoms')))
                <div class="alert alert-danger">
                    {{ $errors->first('prenoms') }}
                </div>
                @endif
            </div>
        </div>
        {{-- <input type="hidden" name="matricule" value="{{ 'MAT'.time() }}"> --}}



    </div>
    <div class="col-md-6">
        <div class="form-group row">
                <label for="contacts" class="col-sm-3 col-form-label">Contacts</label>
                <div class="col-sm-9">
                    <input type="text" name="contacts" maxlength="8"  id="contacts" class="form-control" value="{{ (empty($technicien)) ? old('contacts') : $technicien->contacts }}" onkeypress="chiffres(event)" placeholder="Entrez le contact du technicien">
                    <br>
                    @if (!empty($errors->has('contacts')))
                    <div class="alert alert-danger">
                        {{ $errors->first('contacts') }}
                    </div>
                    @endif
                </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="email" name="email"  id="email" class="form-control" value="{{ (empty($technicien)) ? old('email') : $technicien->email }}" placeholder="Entrez la email du technicien">
            <br>
            @if (!empty($errors->has('email')))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
            @endif
         </div>
        </div>
    </div>
</div>















