<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Produit;
use App\Taille;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use \Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {

        $produit = Produit::find($request->id);
        $taille = Taille::find($request->size);
if($request->size == null){
    $qte_maxi = $produit->qte;
}else {
    $produit_taille = DB::table('produit_taille')
        ->where('produit_id', $produit->id)
        ->where('taille_id', $taille->id)
        ->first();
        $qte_maxi = $produit_taille->qte;
}
        Cart::add(array(
//                                  separe les article de taille differentes
            'id' => $produit->id . $request->size,
            'name' => $produit->nom,
            'price' => $produit->prix_ht,
            'quantity' => $request->qte,
            'attributes' => array(
                'qte_maxi'=>$qte_maxi,
                'size' => $taille,
                'photo' => $produit->photo_principale,
                'prix_ttc' => $produit->prixTTCPanier()
            )
        ));
        return redirect(route('cart_index'))->With('notice', 'le produit <strong>' . $produit->nom . '</strong> a été ajouter au panier');

    }

//    lister les produits du panier
    public function index()
    {
        $content = Cart::getContent();

        $condition = new CartCondition(array(
            'name' => 'TVA 20%',
            'type' => 'tax',
            'target' => 'total',
            'value' => '20%'
        ));

        Cart::condition($condition);
        $total_ht_panier = cart::getSubtotal();
        $total_ttc_panier = Cart::getTotal();

        //        ddd($content);
        $tva = $total_ttc_panier - $total_ht_panier;


        return view('shop.process.panier', [
            'content' => $content,
            'total_ht_panier' => $total_ht_panier,
            'total_ttc_panier' => $total_ttc_panier,
            'tva' => $tva
        ]);

    }

    //    mettre a jour la quantite d'un produit dans le panier
    public function update(Request $request)
        {
        \Cart::update($request ->id, array(
            'quantity'=>array(
                'relative'=> false,
    'value'=>$request->qte
),
));
 return redirect()->route('cart_index')->with('notice','la quantité a ete modifier');
        }

public function remove(Request $request){

        \Cart::remove($request->id);
        return redirect()->route('cart_index')->with('notice','le produit a ete supprimé du panier');
}



}
