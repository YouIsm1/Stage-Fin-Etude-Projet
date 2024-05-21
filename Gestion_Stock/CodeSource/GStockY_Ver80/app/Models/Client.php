<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'id_client';
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $fillable = [
        'nom',  
        'prenom',
        'email',
        'mot_de_passe',
        'id_Role',
        'ID_administrateur',
        'ID_Vendeur',
        'RoleGestionnaire'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_Role');
    }

    // public function gestionnaire()
    // {
    //     if ($this->RoleGestionnaire == 'admin') {
    //         return $this->belongsTo(Administrateur::class, 'ID_gestionnaire');
    //     } else {
    //         return $this->belongsTo(Vendeur::class, 'ID_gestionnaire');
    //     }
    // }

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'ID_administrateur');
    }

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class, 'ID_Vendeur');
    }

    public function gestionnaire()
    {
        if ($this->RoleGestionnaire == 'admin') {
            return $this->administrateur();
        } else {
            return $this->vendeur();
        }
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'ID_Client');
    }

    public function reglements()
    {
        return $this->hasMany(Reglement::class, 'ID_Client');
    }
}
