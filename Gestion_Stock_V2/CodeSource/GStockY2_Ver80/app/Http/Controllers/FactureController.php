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
use App\Models\Facture;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Factures_data = Facture::all();
        return view('page_aff_fact', compact('Factures_data'));
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
        // Validate the request data
        $request->validate([
            'commande_id' => 'required|exists:commandes,id_Commande',
        ], [
            'commande_id.required' => 'Veuillez sélectionner une commande.',
            'commande_id.exists' => 'La commande sélectionnée est invalide.',
        ]);
        

        // Check if a facture already exists for the given commande
        $commande_id = $request->input('commande_id');
        $existing_facture = Facture::where('commande_id', $commande_id)->first();
        // $existing_facture = Facture::where('commande_id', $commande_id);
        // $facture = Facture::where('commande_id', $id_Commande)->first();
        // dd($existing_facture);

        // if ($existing_facture !== null ) {
        if ($existing_facture) {
            return redirect()->back()->with('message_error', 'Une facture existe déjà pour cette commande.');
        }

        // Retrieve related Produit_Commande data
        $produit_commandes = Produit_Commande::where('commande_id', $commande_id)->get();

        // Calculate total amount
        $total_amount = 0;
        foreach ($produit_commandes as $produit_commande) {
            $total_amount += $produit_commande->montant_total;
        }

        // Create a new facture
        try {
            Facture::create([
                'montant_totale' => $total_amount,
                'StatusReglement' => 'En cours', // Default status, change as needed
                'commande_id' => $commande_id,
            ]);

            return redirect()->route('_Fact_.index')->with('message_success', 'Facture ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la création de la facture. Veuillez réessayer.');
        }
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
    public function edit($id_facture)
    {
        $Commandes_data = Commande::all();
        $Factures_data = Facture::find($id_facture);
        return view('page_edit_fact', compact('Commandes_data', 'Factures_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_facture)
    {
        // Validate the request data
        $request->validate([
            'commande_id' => 'required|exists:commandes,id_Commande',
        ], [
            'commande_id.required' => 'Veuillez sélectionner une commande.',
            'commande_id.exists' => 'La commande sélectionnée est invalide.',
        ]);
    
        // Check if a facture already exists for the given commande, excluding the current facture
        $commande_id = $request->input('commande_id');
        $existing_facture = Facture::where('commande_id', $commande_id)->where('id_facture', '!=', $id_facture)->first();
    
        if ($existing_facture) {
            return redirect()->back()->with('message_error', 'Une facture existe déjà pour cette commande.');
        }
    
        // Retrieve the facture to update
        $facture = Facture::find($id_facture);
        if (!$facture) {
            return redirect()->back()->with('message_error', 'Facture introuvable.');
        }
    
        // Retrieve related Produit_Commande data
        $produit_commandes = Produit_Commande::where('commande_id', $commande_id)->get();
    
        // Calculate total amount
        $total_amount = 0;
        foreach ($produit_commandes as $produit_commande) {
            $total_amount += $produit_commande->montant_total;
        }
    
        // Update the facture
        try {
            $facture->update([
                'montant_totale' => $total_amount,
                'StatusReglement' => 'En cours', // Default status, change as needed
                'commande_id' => $commande_id,
            ]);
    
            return redirect()->route('_Fact_.index')->with('message_success', 'Facture mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la mise à jour de la facture. Veuillez réessayer.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_facture)
    {
        try{
            $Facture_dt = Facture::find($id_facture);
            $Facture_dt->delete();

            return redirect()->route('_Fact_.index')->with('message_success', 'Facture supprimé avec succès.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la suppression du Facture. Veuillez réessayer.');
        }
    }


    // Ce block pour ajouter les fct personnalisées
    public function fun_form_Fact(){
        $Commandes_data = Commande::all();
        return view('page_add_fact', compact('Commandes_data'));
    }
}
