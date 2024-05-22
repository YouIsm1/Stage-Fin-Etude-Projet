<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = "categories";
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at
    protected $primaryKey  = "id_categorie";
    protected $fillable =  
        [  
            'nom',  
            'description',
            'ID_Utilisateur_R_administrateur'
        ]; 

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_administrateur');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_categorie');
    }
}
