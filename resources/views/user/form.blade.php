<input type="hidden"name="matricule" value="MAT{{ time() }}">
<div class="form-group row">
          <label for="name" class="col-sm-3 col-form-label">Nom</label>
          <div class="col-sm-9">
            <input type="text" name="name"  id="libelle" class="form-control" value="{{ (empty($user)) ? old('name') : $user->name }}" placeholder="Entrez le nom de l'utilisateur">
            <br>
            @if (!empty($errors->has('name')))
            <div class="alert alert-danger">
                {{ $errors->first('name') }}
            </div>
            @endif
         </div>
</div>

<div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label">Email</label>   
          <div class="col-sm-9">
            <input type="text" name="email"  id="libelle" class="form-control" value="{{ (empty($user)) ? old('email') : $user->email }}" placeholder="Entrez l'email">
            <br>
            @if (!empty($errors->has('email')))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
            @endif
         </div>
</div>

<div class="form-group row">
          <label for="Contacts" class="col-sm-3 col-form-label">Contacts</label>   
          <div class="col-sm-9">
            <input type="text" maxlength="8" onkeypress="chiffres(event)" name="contacts"  id="libelle" class="form-control" value="{{ (empty($user)) ? old('contact') : $user->contacts }}" placeholder="Entrez le contact">
            <br>
            @if (!empty($errors->has('contacts')))
            <div class="alert alert-danger">
                {{ $errors->first('contacts') }}
            </div>
            @endif
         </div>
</div>

<div class="form-group row">
          <label for="password" class="col-sm-3 col-form-label">Mot de passe</label>   
          <div class="col-sm-9">
            <input type="password" name="password"  id="password" class="form-control" value="" placeholder="Entrez le mot de passe">
            <br>
            @if (!empty($errors->has('password')))
            <div class="alert alert-danger">
                {{ $errors->first('password') }}
            </div>
            @endif
         </div>
</div>

<div class="form-group row">
          <label for="password" class="col-sm-3 col-form-label">Confirmation du mot de passe</label>   
          <div class="col-sm-9">
            <input type="password" name="password_confirmation"  id="password" class="form-control" value="" placeholder="confirmer le mot de passe">
            <br>
            @if (!empty($errors->has('password')))
            <div class="alert alert-danger">
                {{ $errors->first('password') }}
            </div>
            @endif
         </div>
</div>
<!--<div class="form-group form-check row ml-4">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
            Se souvenir de moi
        </label>

</div>-->

<div class="form-group row">
 <label for="Libelle" class="col-sm-3 col-form-label">Role</label>
   <div class="col-sm-9">
        <select name="role" id="role" class="form-control" id="formselect2">
           @if((Auth::user()->role === 0))
            <option value="0">Admin</option>
           @endif
            <option value="1">Responsable</option>
            <option value="2">Magasinier 1</option>
            <option value="3">Magasinier 2</option>
        </select>
    </div>
</div>