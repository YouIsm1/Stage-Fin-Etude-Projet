<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $primaryKey  = "id_Role";
    protected $fillable =  
        [  
            'nom_de_role',  
            'description'
        ]; 

    // Define the relationship with the utilisateur model
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'id_Role');
    }

    // Define the relationship with the administrateur model
    public function administrateurs()
    {
        return $this->hasMany(administrateur::class, 'id_Role');
    }

    // Define the relationship with the fournisseurs model
    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class, 'id_Role');
    }

    public function vendeurs()
    {
        return $this->hasMany(Vendeur::class, 'id_Role');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'id_Role');
    }

}
