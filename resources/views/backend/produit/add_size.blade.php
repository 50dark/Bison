@extends('backend')


@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1>Ajouter une taille au produit:{{$produit->nom}} </h1>
        </div>

        <form action="{{route('backend_produit_store_size',['id'=>$produit->id])}}" method="post">
            @csrf
        <div class="row">
            <div class="col-12">
                <label for="type_id" id="type_id"> selectionnez un type de taille </label>
                <select class="form-control change_type" data-id_produit="{{$produit->id}}" name="type_id"
                        id="type_id">
                  @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->nom}}</option>
                  @endforeach
                </select>
            </div>


            </div>
            <div class="load_tailles"></div>
            <div class="form-group text-right">:
                <hr>

                <input type="submit" value="valider" class="btn btn-dark">
            </div>
        </form>
    </main>
@endsection
