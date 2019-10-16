@extends('shop')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}">Accueil</a></li>
           @if($p->categorie && $p->categorie->parent)

            <li class="breadcrumb-item"><a href="{{route('view_by_cat',['id'=>$p->categorie ->parent->id])}}">
                    {{$p->categorie->parent->nom}}</a></li>

            @endif
            @if($p->categorie)
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('view_by_cat',['id'=>$p->categorie->id])}}">{{$p->categorie->nom}}</a>
            </li>
            @endif
        </ol>
    </nav>

    <main role="main">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-6">
                    <div class="card mb-4 box-shadow">
                        <a href="{{route('view_product',['id'=> $p->id])}}">
                        <img src="{{asset('storage/uploads/'.$p->photo_principale)}}"
                             class="card-img-top img-fluid" alt="Responsive image">
                        </a>

                    </div>
                </div>
                <div class="col-6">

                    <h1 class="jumbotron-heading">{{$p->nom}}</h1>
                    <h5>{{$p->prixTTC()}} €</h5>
                    <p class=" lead text-muted">Cinoque aime choco! consectetur adipisicing elit. Dignissimos dolore
                        eaque earum eos ex, exercitationem facilis magni maiores maxime natus neque odit quo quod
                        recusandae tempora unde ut veritatis vero!</p>
                    <hr>
                    <form action="{{route('add_product_cart',['id'=>$p->id])}} " method="POST">
                 @csrf

                    <label for="size">Choisissez votre taille</label>
                    <select name="size" id="size" class="form-control">
                        <option value="xs">XS</option>
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                        <option value="xxl">XXL</option>
                    </select>
                    <p>

{{--                        si  la quanté est 0 le boutton change forme et message--}}
                        @if($p->qte >0)
                            <label for="qte">Quantité</label>
{{--                                                limie a la quantiter disponible--}}
                            <input type="number" min="1"  max="{{$p->qte}}" class="form-control" name="qte" autocomplete="off" value="#">

                        <button class="btn btn-cart my-2 btn-block"><i class="fas fa-shopping-cart"></i>
                            Ajouter au Panier</button>
                        @else
                        <button disabled class="btn btn-cart my-2 btn-block"><i class="fas fa-shopping-cart"></i>
                                En rupture de stock !!! </button>
                        @endif

                    </p>
                   </form>

                </div>
            </div>
        </div>


        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <h3>Vous aimerez aussi :</h3>
                </div>
                <div class="row">
                    @foreach($p->recommandations as $recommandation)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img src="{{asset('storage/uploads/'.$recommandation->photo_principale)}}"
                                 class="card-img-top img-fluid" alt="Responsive image">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="{{route('view_product',['id'=>$recommandation->id])}}"
                                           class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endforeach


                </div>
            </div>
        </div>

    </main>

@endsection
