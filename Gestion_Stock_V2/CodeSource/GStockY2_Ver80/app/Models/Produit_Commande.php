<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit_Commande extends Model
{
    use HasFactory;

    protected $table = 'produit__commandes';

    protected $primaryKey = 'id_produit_commande';
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $fillable = [
        'Quantite',
        'montant_total',
        'produit_id',
        'commande_id'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
}
