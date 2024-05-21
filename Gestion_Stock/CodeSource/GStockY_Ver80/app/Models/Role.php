<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";
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
}
