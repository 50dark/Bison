<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    //Récuperer les produits d'une catégorie
    public function produits()
    {
        return $this->hasMany('App\Produit');
    }

    use SoftDeletes;

//récuperer les categories parente d'une categorie'
    public function parent()
    {
        return $this->belongsTo('App\Categorie');
    }

//récuperer les categories enfant d'une categorie'
    public function enfants()
    {
        return $this->hasMany('App\Categorie', 'parent_id');

    }
}
