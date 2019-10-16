<?php

namespace App\Http\Controllers\Backend;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // lister les tags

    public function index(){
        $tags = Tag::all();
        $categories = Categorie::where("parent_id",'=',null)->paginate(3);
        return view('backend.tag.index',['tags'=>$tags, 'categories'=>$categories]);
    }

//ajouter un tag

    public function add(){
        return view('backend.tag.add');


    }


//    Stocker un tag dans la bd
    public function store(Request $request){
//        validation du form
        $request->validate(['nom'=>'required|max:255']
        );
//        Création de l'objet tab'
        $tag = new Tag();
        $tag ->nom = $request->nom;
//        Sauvegarde dans la bd

        $tag ->save();
//        Redirection vers la page qui liste des tags
        return redirect()->route('backend_tag_index')
            ->with('notice','le tag'.$tag->nom.'a bien été ajouté');
    }
//modifier un tag

public function edit (Request $request){
//        recupere dans la db le tag à modifier
//    on recupere le parametre du tag via l'url defini dans la route
    $tag = Tag::find($request->id);
//    dd($tag);
    return view('backend.tag.edit', ['tag'=>$tag]);

}


public function  update(Request $request) {
        $request->validate([
            'nom'=> 'required|max:255'
        ]);
        $tag = Tag::find($request->id);
        $tag->nom =$request->nom;
        $tag->save();
        return redirect()->route('backend_tag_index')->with('notice','le tag<trong>'.$tag->nom.'</trong> a été modifie');

}

    public function delete(Request $request){
        $tag = Tag::find($request->id);
        $tag->delete ();
        return redirect()->route('backend_tag_index')->with('notice','le tag<trong>'.$tag->nom.'</trong> a été supprimé');



}
}
