<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;
    protected $table = "utilisateurs";
    protected $primaryKey  = "id_Utilisateur";
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
}
