<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Produit;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use \Cart;

class CartController extends Controller
{
    //
    public function add(Request $request){
        $produit = Produit::find($request->id);
        Cart::add(array(
                'id' => $produit->id,
                'name' => $produit->nom,
                'price' => $produit->prix_ht,
                'quantity' => $request->qte,
                'attributes' => array('size'=>$request->size,
                     'photo'=>$produit->photo_principale,
                     'prix_ttc'=>$produit->prixTTC(),
                    )
        ));
        return redirect(route('cart_index'))->With('notice','le produit <strong>'.$produit->nom.'</strong> a été ajouter au panier');

    }

//    lister les produits du panier
    public function index(){
        $total_ht_panier = cart::getSubtotal();
        $content = Cart::getContent();
        $condition = new CartCondition(array(
            'name'=>'TVA 20%',
            'type'=>'tax',
            'target'=>'total',
            'value'=> '20%'
    ));
        Cart::condition($condition);
        $total_ttc_panier= Cart::getTotal();
//        ddd($content);
        $tva = $total_ttc_panier - $total_ht_panier;

        return view('shop.process.panier',[
            'content'=>$content,
            'total_ht_panier'=>$total_ht_panier,
            'total_ttc_panier'=>$total_ttc_panier,
            'tva'=> $tva
        ]);

    }
}
