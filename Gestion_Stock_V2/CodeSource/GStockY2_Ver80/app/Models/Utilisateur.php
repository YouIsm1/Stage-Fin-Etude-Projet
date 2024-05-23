<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Utilisateur extends Model
class Utilisateur extends Authenticatable

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

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

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


    // pour gérer le stock entant que fournisseur  et administrateur 
    public function stocks_Utilisateur_R_Fournisseur()
    {
        return $this->hasMany(Stock::class, 'ID_Utilisateur_R_Fournisseur');
    }

    public function stocks_Utilisateur_R_administrateur()
    {
        return $this->hasMany(Stock::class, 'ID_Utilisateur_R_administrateur');
    }

    // pour gérer les commandes entant que Vendeur et administrateur avec Client
    public function commandes_Utilisateur_R_Vendeur_Admin()
    {
        return $this->hasMany(Commande::class, 'ID_Utilisateur_R_Vendeur_Admin');
    }

    public function commandes_Utilisateur_R_Client()
    {
        return $this->hasMany(Commande::class, 'ID_Utilisateur_R_Client');
    }

    // pour gérer les Reglements entant que Vendeur et administrateur avec Client
    public function reglement_Utilisateur_R_Vendeur_Admin()
    {
        return $this->hasMany(Reglement::class, 'ID_Utilisateur_R_Vendeur_Admin');
    }

    public function reglement_Utilisateur_R_Client()
    {
        return $this->hasMany(Reglement::class, 'ID_Utilisateur_R_Client');
    }
}
