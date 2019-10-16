<?php

namespace App\Http\Controllers\Backend;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //



    public function add(){
        $categories= Categorie::where('parent_id','=',null)->get();
        return view('backend.categorie.add',['categories'=>$categories]);

    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|max:255']
        );

        $categorie = new Categorie();
        $categorie->nom = $request->nom;
        $categorie->parent_id = $request->parent_id;

        if ($request->is_online == 1) {
            $categorie->is_online = $request->is_online;
        } else {
            $categorie->is_online = false;
        }
        $categorie ->save();


        return redirect()->route('backend_tag_index')
            ->with('notice','la categorie <strong> '.$categorie->nom.'</strong>a bien été ajouté');
    }


     public function update (Request  $request ){
        $categorie = Categorie::find($request->id);
        $request->validate(['nom'=>'required|max:255']
        );
        $categorie ->nom= $request->nom;
        $categorie->parent_id=$request->parent_id;
        if ($request->is_online ==1){
            $categorie ->is_online = $request->is_online;}
        else {$categorie->is_online = false;
        }
        $categorie ->save();


        return redirect()->route('backend_tag_index')
            ->with('notice','la categorie <strong> '.$categorie->nom.'</strong>a bien été ajouté');
    }



    public function edit (Request $request){
        $categorie = Categorie::find($request->id);
        $categories = Categorie::where('parent_id','=',null)->get();
        return view('backend.categorie.edit', ['categorie'=>$categorie,'categories'=>$categories]);

    }


    public function delete(Request $request){
        $categorie = Categorie::find($request->id);
        $categorie->delete ();
        return redirect()->route('backend_tag_index')
            ->with('notice','le tag<trong>'.$categorie->nom.'</trong> a été supprimé');


    }


}


