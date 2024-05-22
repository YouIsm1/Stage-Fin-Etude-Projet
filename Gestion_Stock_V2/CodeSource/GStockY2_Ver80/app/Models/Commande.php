<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    protected $primaryKey = 'id_Commande';
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $fillable = [
        'description',
        'ID_Utilisateur_R_Vendeur_Admin',
        'ID_Utilisateur_R_Client'
    ];

    public function Utilisateur_R_Vendeur_Admin()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_Vendeur_Admin');
    }
    public function Utilisateur_R_Client()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_Client');
    }

    
    // donner id au autre table
    public function produitCommandes()
    {
        return $this->hasMany(Produit_Commande::class, 'commande_id');
    }

    public function factures()
    {
        return $this->hasMany(Facture::class, 'commande_id');
    }
}
