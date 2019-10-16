@extends('backend')
@section('content')



            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Gestion des produits</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button class="btn btn-sm btn-outline-secondary">Lister les produits</button>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-secondary">
                            <span data-feather="calendar"></span>
                            Nouveau
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nom du produit</th>
                            <th>Prix</th>
                            <th>Qté</th>

                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produits as $produit)
                            <tr>
                                <td>
                                    {{--                    Affichage de la mignature de l'image--}}
                                    <img width="50" class="img-thumbnail rounded-circle" style="border:3px solid white "
                                         src="{{asset('storage/uploads/'.$produit->photo_principale)}}" alt="">

                                </td>
                            <td>{{$produit->id}}</td>
                            <td>{{$produit->nom}}</td>
                            <td>{{$produit->prix_ht}} €</td>
                            <td>{{$produit->qte}}</td>

                            <td>
                                <a href="{{route('backend_produit_edit',['id'=>$produit->id]) }}" class="btn btn-sm btn-primary">Voir / Modifier</a>
                                <a href="{{route('backend_produit_add_size',['id'=>$produit->id]) }}" class="btn btn-sm btn-outline-primary">gérer les tailles</a>

                                <a onclick="return(confirm('sans regret ? '))" href="{{route('backend_produit_delete',['id'=>$produit->id]) }}" class="btn btn-sm btn-danger">Supprimer</a>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>


    @endsection
