<?php

namespace App\Http\Controllers\Backend;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Produit;
use App\Tag;
use App\Taille;
use App\Type;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ProduitController extends Controller
{
    //
    public function index()
    {

        $produits = Produit::all();
        return view('backend.produit.index', ['produits' => $produits]);
    }


    public function add()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        $recommandations = Produit::all();
        return view('backend.produit.add', ['categories' => $categories, 'tags' => $tags,
            'recommandations' => $recommandations]);

    }



    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'prix_ht',
            'description',
            'qte',
            'categorie_id',
            'photo_principale'=>'required|image|max:1999']
//            ajouté une image
        );
        if ($request->hasFile('photo_principale')) {
            $fileName = $request->file('photo_principale')->getClientOriginalName();
            $request->file('photo_principale')->storeAs('public/uploads', $fileName);
            $img = Image::make($request->file('photo_principale')->getRealPath());
            $img->insert(public_path('img/favicon.png'), 'bottom-right', 10, 10);
//            dd($fileName);
            $img->save('storage/uploads/'. $fileName);
        }
//        php artisan storage:link   pour cree un racourcis entre le dossier "storage" vers dossier "public"
        $produits = new Produit();
        $produits->nom = $request->nom;
        $produits->prix_ht = $request->prix_ht;
        $produits->description = $request->description;
        $produits->photo_principale = $fileName;
        $produits->categorie_id = $request->categorie_id;
        $produits->qte = $request->qte;
        $produits->save();
//        ne faite pas de foreach si tag est null ( evite d'envoyer une donnée null dans la db qui cause une erreur)
if($request->tags) {
    foreach ($request->tags as $id) {
        $produits->tags()->attach($id);
    }
}
//        ne faite pas de foreach si produits_recommandé est null ( evite d'envoyer une donnée null dans la db qui cause une erreur)
 if($request->produits_recommandes) {
     foreach ($request->produits_recommandes as $id) {
//           en lien avec l'objet produit
         $produits->recommandations()->attach($id);
     }
 }
        return redirect()->route('backend_homepage')
            ->with('notice', 'le <strong>' . $produits->nom . '</strong> a bien été ajouté');
    }





    public function edit(Request $request)
    {
//      declaration
        $produits = Produit::all();
        $tags = Tag::all();
        $categories = Categorie::all();
//        interroger et importe les donne
        $produit = Produit::find($request->id);

        $tags_id=[];
        foreach ($produit->tags as $t) {
            $tags_id[]=$t->id;
        }

        $produit_recommandations=[];
        foreach ($produit->recommandations as $r) {
            $produit_recommandations[]=$r->id;
        }
//        $t = Tag::find(1);
//        $categories = Categorie::where('parent_id','=',null)->get();
//        $tags = Tag::where('id','=',null)->get();
//        $recommandations = Produit::all();
//        if (in_array($t,$produits->tags){dd('bim')});
        return view('backend.produit.edit', [
            'categories' => $categories,
            'tags' => $tags,
            'produits' => $produits,
            'produit' => $produit,
            'tags_id'=>$tags_id,
            'produit_recommandations' => $produit_recommandations,
            'photo_principale'=>'required|image|max:1999'

        ]);

    }


    public function update (Request $request){
        $produits = Produit::find($request->id);
            $request->validate([
                'nom' => 'required|max:255',
                'prix_ht',
                'description',
                'qte',
                'categorie_id']);

        if ($request->hasFile('photo_principale')) {
            $fileName = $request->file('photo_principale')->getClientOriginalName();
            $request->file('photo_principale')->storeAs('public/uploads', $fileName);
            $img = Image::make($request->file('photo_principale')->getRealPath());
            $img->insert(public_path('img/favicon.png'), 'bottom-right', 10, 10);
//            dd($fileName);
            $img->save('storage/uploads/'. $fileName);
            $produits->photo_principale = $fileName;

        }
            $produits->nom = $request->nom;
            $produits->prix_ht = $request->prix_ht;
            $produits->description = $request->description;
            $produits->categorie_id = $request->categorie_id;
            $produits->qte = $request->qte;
            $produits->save();
            $produits->tags()->sync($request->tags);
            $produits->recommandations()->sync($request->produits_recommandes);

            return redirect()->route('backend_homepage')
                ->with('notice','le produit <strong>'.$produits->nom. "</strong> a bien été modifié");


    }


    public function delete(Request $request)
    {
        $produits = Produit::find($request->id);
        $produits->delete ();
        return redirect()->route('backend_produit_index')
            ->with('notice','le produit <trong>'.$produits->nom.'</trong> a été supprimé');
    }

    //Ajouter une taille et un stock
        public function addSize(Request $request){
        $produit = Produit::find($request->id);
        $types= Type::all();
        return view('backend.produit.add_size',['produit'=>$produit, 'types'=> $types ]);
    }

    public function selectSizeAjax(Request $request){
        $type_id = $request->type_id;
        $type = Type::find ($type_id);

        return view('backend.produit.select_tailles_ajax',['tailles'=>$type->tailles]);
    }

//    stocké la taille et le produit selectionné
public function  storeSize(Request $request){
//dd($request->all());
    $produit = Produit::find($request->id);
//    association de la taille et la quantité
    $produit->tailles()->attach($request->taille_id, ['qte'=>$request->qte]);

    return redirect()->route('backend_produit_add_size',['id'=>$produit->id])
        ->with('notice','la taille pour le produit <strong>'.$produit->nom.'</strong> a bien ete ajoutée');
}

}
