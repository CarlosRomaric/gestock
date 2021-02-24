<div class="row">
    <div class="col-md-6">

        <div class="form-group row">
            <label for="numBonCommande" class="col-sm-3 col-form-label">N° Bon de Commande</label>
            <div class="col-sm-9">
                <input type="text" name="numBonCommande"   id="numBonCommande" class="form-control" value="{{ (empty($produit)) ? old('numBonCommande') : $produit->numBonCommande }}" placeholder="Entrez la référence du produit">
                <br>
                @if (!empty($errors->has('numBonCommande')))
                <div class="alert alert-danger">
                    {{ $errors->first('numBonCommande') }}
                </div>
                @endif
            </div>
        </div>


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
        <label for="">Localisation</label>
        <hr>
        <div class="form-group row">
            <label for="magasin" class="col-sm-3 col-form-label">Magasin</label>
            <div class="col-sm-9">
              <input type="text" name="magasin"  id="magasin" class="form-control" value="{{ (empty($produit)) ? old('magasin') : $produit->magasin }}" placeholder="Entrez le nom du produit">
              <br>
              @if (!empty($errors->has('magasin')))
              <div class="alert alert-danger">
                  {{ $errors->first('magasin') }}
              </div>
              @endif
           </div>
          </div>

        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Etagère</label>
            <div class="col-sm-9">
                <input name="etagere"   id="etagere" class="form-control" value="{{ (empty($produit)) ? old('etagere') : $produit->etagere }}" placeholder="Entrez ou est situé l'étagère dd l'article">
                <br>
                @if (!empty($errors->has('etagere')))
                <div class="alert alert-danger">
                    {{ $errors->first('etagere') }}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Rangée</label>
            <div class="col-sm-9">
                <input name="rangee"   id="rangee" class="form-control" value="{{ (empty($produit)) ? old('rangee') : $produit->rangee }}" placeholder="Entrez ou est situé l'étagère dd l'article">
                <br>
                @if (!empty($errors->has('rangee')))
                <div class="alert alert-danger">
                    {{ $errors->first('rangee') }}
                </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Brève description</label>
            <div class="col-sm-9">
                <textarea name="subtitle"   id="subtitle" class="form-control" value="" rows="5" placeholder="Entrez une brève description sur l'article">{{ (empty($produit)) ? old('subtitle') : $produit->subtitle }}</textarea>
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
            <label for="poids" class="col-sm-3 col-form-label">poids</label>
            <div class="col-sm-9">

                <input type="text" name="poids"  id="poids" class="form-control" value="{{ (empty($produit)) ? old('qteMin') : $produit->qteMin }}" onkeypress="chiffres(event)" placeholder="Entrez le poids du produit">
                <br>
                @if (!empty($errors->has('poids')))
                <div class="alert alert-danger mt-4">
                    {{ $errors->first('poids') }}
                </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
          <label for="famille_id" class="col-sm-3 col-form-label">Famille</label>
          <div class="col-sm-9">

            <select name="famille_id"  class="js-example-basic-single w-100" id="">
                <option value="">Choisissez votre famille de produit</option>
                @foreach($familles as $key => $famille)
                    <option value="{{ $key }}" class="text-uppaercase"  {{ ($selected == $key) ? "selected" : '' }}  ><label for="" class="text-uppercase">{{ $famille }}</label></option>
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
            <label for="description" class="col-sm-3 col-form-label">Remarque</label>
            <div class="col-sm-9">
                <textarea name="description" rows="12"  id="description" class="form-control" value="" placeholder="Entrez la remarque de l'article">{{ (empty($produit)) ? old('description') : $produit->description }}</textarea>
                <br>
                @if (!empty($errors->has('description')))
                <div class="alert alert-danger">
                    {{ $errors->first('description') }}
                </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
          <label for="price" class="col-sm-3 col-form-label">Prix Achat</label>
          <div class="col-sm-9">
            <input type="text" name="price"  id="price" onkeypress="chiffres(event)" class="form-control" value="{{ (empty($produit)) ? old('price') : $produit->price }}" placeholder="Entrez le prix d'Achat du produit">
            <br>
            @if (!empty($errors->has('price')))
            <div class="alert alert-danger">
                {{ $errors->first('price') }}
            </div>
            @endif
         </div>
        </div>

        <div class="form-group row">
            <label for="unite" class="col-sm-3 col-form-label">Unité</label>
            <div class="col-sm-9">

                <select name="unite"  class="js-example-basic-single w-100 " id="">
                    <option value="">Choisissez votre l'unité de l'article</option>
                    <option value="Litre" class="text-uppercase">Litre</option>
                    <option value="Metre" class="text-uppercase">Metre</option>
                    <option value="Tonne" class="text-uppercase">Tonne</option>
                    <option value="Carton" class="text-uppercase">Carton</option>
                    <option value="Specimen" class="text-uppercase">Specimen</option>

                </select>
                <br>
                @if (!empty($errors->has('unite')))
                <div class="alert alert-danger mt-4">
                    {{ $errors->first('unite') }}
                </div>
                @endif
            </div>
        </div>


        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Prix de Vente</label>
            <div class="col-sm-9">
              <input type="text" name="priceSeller"  id="priceSeller" class="form-control" value="{{ (empty($produit)) ? old('priceSeller') : $produit->priceSeller }}" onkeypress="chiffres(event)" placeholder="Entrez le prix de vente du produit">
              <br>
              @if (!empty($errors->has('priceSeller')))
              <div class="alert alert-danger">
                  {{ $errors->first('priceSeller') }}
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
                    <option value="">Choisissez votre fournisseur d'article</option>
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




        {{-- <div class="form-group row">
            <label for="statusTva" class="col-sm-3 col-form-label">Applicable a la TVA 18%</label>
            <div class="col-sm-9">

                <input type="checkbox" name="statusTva" value="1">
                <br>
                @if (!empty($errors->has('statusTva')))
                <div class="alert alert-danger mt-4">
                    {{ $errors->first('statusTva') }}
                </div>
                @endif
            </div>
        </div> --}}

    </div>

</div>















