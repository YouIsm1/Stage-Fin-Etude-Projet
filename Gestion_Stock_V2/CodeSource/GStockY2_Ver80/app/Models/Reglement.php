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
        'date_reglement',
        'Facture_ID',
        'ID_Utilisateur_R_Client',
        'ID_Utilisateur_R_Vendeur_Admin',
        'ResteDeMontantFacture'
    ];


    public function Facture()
    {
        return $this->belongsTo(Facture::class, 'Facture_ID');
    }
    public function Utilisateur_R_Client()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_Client');
    }
    public function Utilisateur_R_Vendeur_Admin()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_Utilisateur_R_Vendeur_Admin');
    }


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (is_null($model->date_reglement)) {
    //             $model->date_reglement = now();
    //         }
    //     });
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->date_reglement)) {
                $model->date_reglement = now();
            }
        });
    }


}
