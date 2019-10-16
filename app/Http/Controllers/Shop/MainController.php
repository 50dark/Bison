<?php

namespace App\Http\Controllers\Shop;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Produit;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //Afficher la page d'accueil
    public function index()
    {
        $produits = Produit::all();


//        dd($produits);
        return view('shop.index', ['produits' => $produits]);
    }

    //Voir les produits d'une catégorie
    public function viewByCategorie(Request $request)
    {

        $cat = Categorie::find($request->id);
        $produits = $cat->produits;

        return view('shop.categorie', [ 'produits' => $produits,'cat'=>$cat]);
    }

    //Voir le produit
    public function viewProduct(Request $request)
    {

        $p = Produit::find($request->id);

        return view('shop.produit', ['p' => $p,]);
    }
}
