<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks'; // nom de la table pivot
    protected $primaryKey = 'id_stock'; // nom de la clé primaire
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $fillable = [
        'Quantite',
        'status',
        'ID_Produit',
        'ID_Utilisateur_R_Fournisseur',
        'ID_Utilisateur_R_administrateur'
    ];

    
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'ID_Produit');
    }

    public function Utilisateur_R_Fournisseur()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_Fournisseur');
    }
    public function Utilisateur_R_administrateur()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_administrateur');
    }
}
