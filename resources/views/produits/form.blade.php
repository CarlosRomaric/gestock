<div class="row">
    <div class="col-md-6">

        <div class="form-group row">
            <label for="ref" class="col-sm-3 col-form-label">Reference</label>
            <div class="col-sm-9">
                <input type="text" name="ref"   id="ref" class="form-control" value="{{ (empty($produit)) ? old('ref') : $produit->ref }}" placeholder="Entrez la référence du produit">
                <br>
                @if (!empty($errors->has('ref')))
                <div class="alert alert-danger">
                    {{ $errors->first('ref') }}
                </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
          <label for="designation" class="col-sm-3 col-form-label">Designation</label>
          <div class="col-sm-9">
            <input type="text" name="designation"  id="designation" class="form-control" value="{{ (empty($produit)) ? old('designation') : $produit->designation }}" placeholder="Entrez le nom du produit">
            <br>
            @if (!empty($errors->has('designation')))
            <div class="alert alert-danger">
                {{ $errors->first('designation') }}
            </div>
            @endif
         </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Brève description</label>
            <div class="col-sm-9">
                <textarea name="subtitle"   id="subtitle" class="form-control" value="" rows="5" placeholder="Entrez une brève description du produit">{{ (empty($produit)) ? old('subtitle') : $produit->subtitle }}</textarea>
                <br>
                @if (!empty($errors->has('subtitle')))
                <div class="alert alert-danger">
                    {{ $errors->first('subtitle') }}
                </div>
                @endif
            </div>
        </div>
        @if( route('produits.edit', $idproduit) <> url()->current() )
        <div class="form-group row">
          <label for="qteStock" class="col-sm-3 col-form-label">Quantité en stock</label>
          <div class="col-sm-9">
            
            <input type="text" name="qteStock"  id="qteStock" onkeypress="chiffres(event)" class="form-control" value="{{ (empty($produit)) ? old('qteStock') : $produit->qteStock }}" placeholder="Entrez la quantité du produit en stock" {{ $disabled }}>
           
            <br>
            @if (!empty($errors->has('qteStock')))
            <div class="alert alert-danger">
                {{ $errors->first('qteStock') }}
            </div>
            @endif
            </div>
        </div>
        @else
        <input type="hidden" name="qteStock" value="{{ (empty($produit)) ? old('qteStock') : $produit->qteStock }}">
        @endif

        <div class="form-group row">
          <label for="famille_id" class="col-sm-3 col-form-label">Famille</label>
          <div class="col-sm-9">
            
            <select name="famille_id"  class="js-example-basic-single w-100" id="">
                <option value="">Choisissez votre famille de produit</option>
                @foreach($familles as $key => $famille)
                    <option value="{{ $key }}"  {{ ($selected == $key) ? "selected" : '' }}  ><label for="" class="text-uppercase">{{ $famille }}</label></option>
                @endforeach
            </select>
            <br>
            @if (!empty($errors->has('famille_id')))
            <div class="alert alert-danger mt-4">
                {{ $errors->first('famille_id') }}
            </div>
            @endif
            </div>
        </div>

       <div class="form-group row mb-t">
            <label for="image" class="col-sm-3  col-form-label">Image</label>

            <input type="file" name="image" class="file-upload-default">
            <div class="input-group col-sm-9">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Charger une Image du produit">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">uploader</button>
                </span>
            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group row">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
                <textarea name="description" rows="12"  id="description" class="form-control" value="" placeholder="Entrez la description du produit">{{ (empty($produit)) ? old('description') : $produit->description }}</textarea>
                <br>
                @if (!empty($errors->has('description')))
                <div class="alert alert-danger">
                    {{ $errors->first('description') }}
                </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
          <label for="price" class="col-sm-3 col-form-label">Prix unitaire</label>
          <div class="col-sm-9">
            <input type="text" name="price"  id="price" onkeypress="chiffres(event)" class="form-control" value="{{ (empty($produit)) ? old('price') : $produit->price }}" placeholder="Entrez le prix unitaire  du produit">
            <br>
            @if (!empty($errors->has('price')))
            <div class="alert alert-danger">
                {{ $errors->first('price') }}
            </div>
            @endif
         </div>
        </div>

        <div class="form-group row">
          <label for="name" class="col-sm-3 col-form-label">Seuil d'alerte</label>
          <div class="col-sm-9">
            <input type="text" name="qteMin"  id="qteMin" class="form-control" value="{{ (empty($produit)) ? old('qteMin') : $produit->qteMin }}" onkeypress="chiffres(event)" placeholder="Entrez la quantité minimal du produit pour passer une commande">
            <br>
            @if (!empty($errors->has('qteMin')))
            <div class="alert alert-danger">
                {{ $errors->first('qteMin') }}
            </div>
            @endif
         </div>
        </div>

          <div class="form-group row">
            <label for="fournisseur_id" class="col-sm-3 col-form-label">Fournisseur</label>
            <div class="col-sm-9">
                
                <select name="fournisseur_id"  class="js-example-basic-single w-100 " id="">
                    <option value="">Choisissez votre fournisseur de produit</option>
                    @foreach($fournisseurs as $key=> $fournisseur)

                        <option value="{{ $key }}" class="text-uppercase"  {{ ($selected2 == $key) ? "selected" : "" }} >{{ $fournisseur }}</option>
                    @endforeach
                </select>
                <br>
                @if (!empty($errors->has('fournisseur_id')))
                <div class="alert alert-danger mt-4">
                    {{ $errors->first('fournisseur_id') }}
                </div>
                @endif
            </div>
        </div>


    </div>

</div>















