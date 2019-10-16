<div class="row">
    <div class="col-12">
        <label for="taille_id" class="">selectionner une taille</label>
        <select class="form-control" name="taille/id" id="taille">
            @foreach($tailles as $taille)
                <option value="{{$taille->id}}">{{$taille->nom}}</option>
            @endforeach
        </select>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <label for="qte" class="">Quantité</label>
        <input type="number" min="0" name="qte" class="form-control">
    </div>
</div>

