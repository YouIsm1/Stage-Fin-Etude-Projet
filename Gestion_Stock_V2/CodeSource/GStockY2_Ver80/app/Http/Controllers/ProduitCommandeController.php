<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// pour importer les models
use App\Models\Role;
use App\Models\Utilisateur;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Photo_Produit;
use App\Models\Stock;
use App\Models\Commande;
use App\Models\Produit_Commande;

class ProduitCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_produit_commande)
    {
        try {
            $produit_commande = Produit_Commande::find($id_produit_commande);
            $produit_commande->delete();

            // Récupérer le produit correspondant
            $produit = Produit::findOrFail($produit_commande->produit_id);
        
            // Ajuster la quantité du produit en fonction du type de stock
            // if ($stock->status === 'Sortant') {
            //     $produit->quantite += $stock->Quantité;
            // } elseif ($stock->status === 'Entrant') {
            //     if ($produit->quantite < $stock->Quantité) {
            //         $produit->quantite = 0;
            //     }else{
            //         $produit->quantite -= $stock->Quantité;
            //     }  
            // }

            $produit->quantite += $produit_commande->Quantite;
        
            // Sauvegarder les modifications du produit
            $produit->save();

            // return redirect()->route('_stock_.index')->with('message_success', 'Stock supprimé avec succès.');
            return redirect()->back()->with('message_success', 'Produit associee supprimé avec succès.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la suppression du Produit associee. Veuillez réessayer.');
        }
    }
}
