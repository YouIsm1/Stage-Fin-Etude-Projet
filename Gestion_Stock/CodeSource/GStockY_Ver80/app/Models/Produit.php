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
            'id_administrateur',
            'id_categorie'
        ]; 

    public function administrateur()
    {
        return $this->belongsTo(administrateur::class, 'id_administrateur');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    // pour donner le id au autre tableau
    public function stocks()
    {
        return $this->hasMany(stock::class, 'id_produit');
    }
}
