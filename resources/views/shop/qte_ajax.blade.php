
@if($qte >0)
<label for="qte">Quantité</label>
{{--                                                limie a la quantiter disponible--}}
{{--<input type="number" min="1"  max="{{$p->qte}}" class="form-control" name="qte" autocomplete="off" value="#">--}}

<select name="qte" id="qte" class="form-control">
@for($i=1;$i<=$qte;$i++)
    <option value="{{$i}}">{{$i}}</option>
@endfor
    </select>

    <button class="btn btn-cart my-2 btn-block"><i class="fas fa-shopping-cart">

    </i>Ajouter au Panier</button>
 @else
    <button disabled class="btn btn-danger my-2 btn-block">
    <i class="fas fa-shopping-cart"></i>
    rupture de stock !!</button>
@endif
