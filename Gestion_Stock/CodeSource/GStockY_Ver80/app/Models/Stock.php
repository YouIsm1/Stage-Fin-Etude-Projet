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
        'ID_Fournisseur',
        'ID_Produit',
        'Quantite',
        'status',
        'ID_Administrateur'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'ID_Fournisseur');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'ID_Produit');
    }

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'ID_Administrateur');
    }

}
