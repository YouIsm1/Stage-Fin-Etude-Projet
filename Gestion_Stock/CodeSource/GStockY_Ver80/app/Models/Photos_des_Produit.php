<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos_des_Produit extends Model
{
    use HasFactory;

    protected $table = 'photos_des__produits';
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at
    protected $primaryKey  = "id_photo";
    protected $fillable = [
        'produit_id',
        'nom',
        'path'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
