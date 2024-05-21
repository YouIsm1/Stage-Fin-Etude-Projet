<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    
    protected $table = 'reglements';
    protected $primaryKey = 'id_reglement';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'montant_de_reglement',
        'RoleGestionnaire',
        'date_reglement',
        'ID_administrateur',
        'ID_Vendeur',
        'ID_Client'
    ];

    public function administrateur()
    {
        return $this->belongsTo(administrateur::class, 'ID_administrateur');
    }

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class, 'ID_Vendeur');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'ID_Client');
    }
}
