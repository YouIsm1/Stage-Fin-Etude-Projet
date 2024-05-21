<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class administrateur extends Model
{
    use HasFactory;
    protected $table = "administrateurs";
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $primaryKey  = "id_administrateur";
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

    // id_administrateur pour les autres tableaus 
    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class, 'id_administrateur');
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class, 'id_administrateur');
    }

    public function stocks()
    {
        return $this->hasMany(stock::class, 'id_administrateur');
    }
}
