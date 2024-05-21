<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit_Commande extends Model
{
    use HasFactory;

    
    protected $table = 'produit__commandes';
    public $incrementing = false;
    protected $fillable = [
        'Quantite',
        'produit_id',
        'commande_id'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
}
