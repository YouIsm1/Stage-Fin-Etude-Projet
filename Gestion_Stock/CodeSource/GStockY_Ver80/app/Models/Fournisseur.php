<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $table = "fournisseurs";
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $primaryKey  = "id_Fournisseur";
    protected $fillable =  
        [  
            'nom',  
            'prenom',
            'email',
            'mot_de_passe',
            'id_Role',
            'id_administrateur'
        ]; 

    // Define the relationship with the role model
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_Role');
    }

    public function administrateur()
    {
        return $this->belongsTo(administrateur::class, 'ID_administrateur');
    }

    // pour donner le id au autre tableau
    public function stocks()
    {
        return $this->hasMany(stock::class, 'ID_Fournisseur');
    }
}
