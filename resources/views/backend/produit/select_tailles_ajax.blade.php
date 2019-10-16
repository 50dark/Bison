<div class="row">
    <div class="col-12">
        <label for="taille_id" class="">selectionner une taille</label>
        <select class="form-control" name="taille_id" id="taille">
            @foreach($tailles as $taille)
                @if(in_array($taille->id,$tailles_produit_ids))
                <option disabled value="{{$taille->id}}">{{$taille->nom}}</option>
                @else
                    <option value="{{$taille->id}}">{{$taille->nom}}</option>
                @endif
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

