<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    use HasFactory;

    protected $table = "vendeurs";
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $primaryKey  = "id_Vendeur";
    protected $fillable =  
        [  
            'nom',  
            'prenom',
            'email',
            'mot_de_passe',
            'id_Role',
            'id_administrateur'
        ]; 

        public function role()
    {
        return $this->belongsTo(Role::class, 'id_Role');
    }

        public function administrateur()
    {
        return $this->belongsTo(administrateur::class, 'ID_administrateur');
    }


    // pour donner id_vendeur au autre tableau
    
    // public function clients()
    // {
    //     return $this->hasMany(Client::class, 'ID_gestionnaire')->where('RoleGestionnaire', 'vendeur');
    // }

    public function clients()
    {
        return $this->hasMany(Client::class, 'ID_Vendeur')->where('RoleGestionnaire', 'vendeur');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'ID_Vendeur');
    }

    public function reglements()
    {
        return $this->hasMany(Reglement::class, 'ID_Vendeur');
    }
}
