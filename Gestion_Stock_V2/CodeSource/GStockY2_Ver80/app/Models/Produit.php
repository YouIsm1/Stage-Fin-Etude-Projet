<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = "produits";
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $primaryKey  = "id_produit";
    protected $fillable =  
        [  
            'nom',  
            'quantite',
            'description',
            'prix',
            'ID_Utilisateur_R_administrateur',
            'id_categorie'
        ]; 

    
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_administrateur');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    // pour donner le id au autre tableau
    public function photos()
    {
        return $this->hasMany(Photo_Produit::class, 'produit_id');
    }
    // pour donner le id au autre tableau
    public function stocks()
    {
        return $this->hasMany(stock::class, 'ID_Produit');
    }

    public function produitCommandes()
    {
        return $this->hasMany(Produit_Commande::class, 'produit_id');
    }
}
