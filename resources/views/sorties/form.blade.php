<div class="form-group row">
    <label for="technicien_id" class="col-sm-3 col-form-label">Nom du Technicien</label>
    <div class="col-sm-9">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="date" value="{{ date('Y-m-d H:i:s') }}">
        <select name="technicien_id"  class="js-example-basic-single w-100 " id="">
                    <option value="">Choisissez votre technicien de produit</option>
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