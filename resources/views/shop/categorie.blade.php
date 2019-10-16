@extends('shop')

@section('content')
    {{--ici la liste des tshirt de la catégorie--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @if($cat->parent !==null)
            <li class="breadcrumb-item" aria-current="page">
                <a href="{{route('view_by_cat',['id'=>$cat->parent->id])}}">{{$cat->nom}}</a>
            </li>
            @endif
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{route('view_by_cat',['id'=>$cat->id])}}">{{$cat->nom}}</a>
                </li>
            @if($cat->enfants)
                @foreach($cat->enfants as $enfant)
            <li class="breadcrumb-item active">
                <a href="{{route('view_by_cat',['id'=>$enfant->nom])}}">{{$enfant->nom}}</a></li>
                @endforeach
                @endif
        </ol>
    </nav>
    <main role="main">
        <div class="py-3">
            <div class="container-fluid">
                <div class="row">
                    @foreach($produits as $produit)
                        <div class="col-md-3">
                            <div class="card mb-4 box-shadow">
                                <a href="{{route('view_product',['id'=>$produit->id])}}">
                                <img src="{{asset('storage/uploads/'.$produit->photo_principale)}}"
                                     class="card-img-top img-fluid" alt="Responsive image">
                                </a>
                                <div class="card-body">
                                    <p class="card-text">{{$produit->nom}}<br>{{$produit->decription}} </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="price">{{$produit->prixTTC()}} €</span>
                                                <i class="fas fa-eye"></i>
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
