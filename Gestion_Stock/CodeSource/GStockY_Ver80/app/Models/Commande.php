<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    protected $primaryKey = 'id_Commande';
    public $incrementing = true; // l'incrémentation automatique de la clé primaire
    public $timestamps = true; // pour gérer les colonnes created_at et updated_at

    protected $fillable = [
        'description',
        'RoleGestionnaire',
        'ID_administrateur',
        'ID_Vendeur',
        'ID_Client'
    ];

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'ID_administrateur');
    }

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class, 'ID_Vendeur');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'ID_Client');
    }

    public function gestionnaire()
    {
        if ($this->RoleGestionnaire == 'admin') {
            return $this->administrateur();
        } else {
            return $this->vendeur();
        }
    }

    // donner id au autre table
    public function produitCommandes()
    {
        return $this->hasMany(Produit_Commande::class, 'commande_id');
    }

    public function factures()
    {
        return $this->hasMany(Facture::class, 'commande_id');
    }
}
