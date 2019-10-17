<label for="qte">Quantité</label>
{{--                                                limie a la quantiter disponible--}}
<input type="number" min="1"  max="{{$p->qte}}" class="form-control" name="qte" autocomplete="off" value="#">

<button class="btn btn-cart my-2 btn-block"><i class="fas fa-shopping-cart"></i>
    Ajouter au Panier</button>
