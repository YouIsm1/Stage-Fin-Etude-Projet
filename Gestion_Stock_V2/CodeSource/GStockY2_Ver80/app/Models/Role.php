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

    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'id_Role');
    }


}
