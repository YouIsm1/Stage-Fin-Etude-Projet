<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = "utilisateurs";
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at
    protected $primaryKey  = "id_Utilisateur";
    protected $fillable =  
        [  
            'nom',  
            'prenom',
            'email',
            'mot_de_passe',
            'id_Role'
        ]; 

    // Define the relationship with the role model
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_Role');
    }


    // donner id utilisateur aux autre tableaux
    public function categories()
    {
        return $this->hasMany(Categorie::class, 'ID_Utilisateur_R_administrateur');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'ID_Utilisateur_R_administrateur');
    }
}
