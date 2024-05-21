<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';
    protected $primaryKey = 'id_facture';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'montant_totale',
        'StatusReglement',
        'commande_id'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
}
