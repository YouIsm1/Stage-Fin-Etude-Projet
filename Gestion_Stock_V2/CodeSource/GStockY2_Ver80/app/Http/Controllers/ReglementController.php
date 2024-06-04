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
use App\Models\Reglement;

class ReglementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Reglements_data = Reglement::all();
        return view('page_aff_regl', compact('Reglements_data'));
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
    try {
        $request->validate([
            'montant_de_reglement' => 'required|numeric|min:0',
            'Facture_ID' => 'required|exists:factures,id_facture',
            'ID_Utilisateur_R_Client' => 'required|exists:utilisateurs,id_Utilisateur',
        ], [
            'montant_de_reglement.required' => 'Le montant du règlement est requis.',
            'montant_de_reglement.numeric' => 'Le montant du règlement doit être un nombre.',
            'montant_de_reglement.min' => 'Le montant du règlement doit être supérieur ou égal à :min.',
            'Facture_ID.required' => 'Le choix de la facture est requis.',
            'Facture_ID.exists' => 'La facture sélectionnée n\'existe pas.',
            'ID_Utilisateur_R_Client.required' => 'Le client est requis.',
            'ID_Utilisateur_R_Client.exists' => 'Le client sélectionné n\'existe pas.',
        ]);

        $facture = Facture::findOrFail($request->Facture_ID);
        $montant_de_reglement = $request->montant_de_reglement;

        // Récupérer le dernier règlement pour cette facture, s'il existe
        $dernier_reglement = $facture->Reglements->last();

        if ($dernier_reglement) {
            // Utiliser ResteDeMontantFacture du dernier règlement
            $reste_a_payer = $dernier_reglement->ResteDeMontantFacture;
        } else {
            // Si aucun règlement n'existe, utiliser le montant total de la facture
            $reste_a_payer = $facture->montant_totale;
        }

        if ($reste_a_payer < $montant_de_reglement) {
            return back()->with('message_error', 'Le montant du règlement est supérieur au montant restant de la facture.');
        }

        // Calcul du nouveau reste à payer
        $nouveau_reste = $reste_a_payer - $montant_de_reglement;

        // Création du nouveau règlement
        $reglement = Reglement::create([
            'montant_de_reglement' => $montant_de_reglement,
            'date_reglement' => now(),
            'Facture_ID' => $request->Facture_ID,
            'ID_Utilisateur_R_Client' => $request->ID_Utilisateur_R_Client,
            // 'ID_Utilisateur_R_Vendeur_Admin' => session('utilisateur.id_Utilisateur'),
            'ID_Utilisateur_R_Vendeur_Admin' => $request->ID_Utilisateur_R_administrateur,
            'ResteDeMontantFacture' => $nouveau_reste,
        ]);

        // Mettre à jour le statut de la facture si le montant restant est 0
        if ($nouveau_reste == 0) {
            $facture->update(['StatusReglement' => 'Terminée']);
        }else{
            $facture->update(['StatusReglement' => 'En cours']);
        }

        return redirect()->route('_Regl_.index')->with('message_success', 'Le règlement a été ajouté avec succès.');
    } catch (\Exception $e) {
        // Log any unexpected exceptions for debugging
        // \Log::error($e);
        return back()->with('message_error', 'Une erreur est survenue lors de l\'ajout du règlement. Veuillez réessayer plus tard.');
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
    public function edit($id_reglement)
    {
        $Reglement_data = Reglement::find($id_reglement);
        // dd($Reglement_data);
        
        if (!$Reglement_data) {
            return redirect()->route('_Regl_.index')->with('message_error', 'Reglement introuvable.');
        }

        // return view('page_edit_user', compact('user_data', 'roles_data'));

        // $administrateurs = Utilisateur::where('id_Role', 1)->get();
        // $fournisseurs = Utilisateur::where('id_Role', 10)->get();
        // $produits_data = Produit::with('photos')->get();
        // dd($Stock_data);
        $clients = Utilisateur::where('id_Role', 3)
                        ->whereHas('commandes_Utilisateur_R_Client.factures')
                        ->get();
        // dd($clients);
        $Factures_data = Facture::with('Reglements')->get();
        $factures_montant_restant = [];

        // Calculer le montant restant pour chaque facture
        foreach ($Factures_data as $facture) {
            if ($facture->Reglements->isNotEmpty()) {
                $totalReglements = $facture->Reglements->sum('montant_de_reglement');
                $montant_restant = $facture->montant_totale - $totalReglements;
            } else {
                $montant_restant = $facture->montant_totale;
            }
            $factures_montant_restant[$facture->id_facture] = $montant_restant;
        }
        return view('page_edit_regl', compact('Reglement_data', 'clients', 'Factures_data', 'factures_montant_restant'));
        // return view('page_edit_stock', compact('Stock_data', 'administrateurs', 'fournisseurs', 'produits_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_reglement)
    {
        try {
            $request->validate([
                'montant_de_reglement' => 'required|numeric|min:0',
                'Facture_ID' => 'required|exists:factures,id_facture',
                'ID_Utilisateur_R_Client' => 'required|exists:utilisateurs,id_Utilisateur',
            ], [
                'montant_de_reglement.required' => 'Le montant du règlement est requis.',
                'montant_de_reglement.numeric' => 'Le montant du règlement doit être un nombre.',
                'montant_de_reglement.min' => 'Le montant du règlement doit être supérieur ou égal à :min.',
                'Facture_ID.required' => 'Le choix de la facture est requis.',
                'Facture_ID.exists' => 'La facture sélectionnée n\'existe pas.',
                'ID_Utilisateur_R_Client.required' => 'Le client est requis.',
                'ID_Utilisateur_R_Client.exists' => 'Le client sélectionné n\'existe pas.',
            ]);
    
            $reglement = Reglement::findOrFail($id_reglement);
            $facture = Facture::findOrFail($request->Facture_ID);
            $montant_de_reglement = $request->montant_de_reglement;
    
            // Récupérer le dernier règlement pour cette facture, s'il existe
            // $dernier_reglement = $facture->Reglements->last();
            // $reglements = $facture->Reglements->get()->reverse()->skip(1);
            // $dernier_reglement = $reglements->first();

            // Récupérer tous les règlements pour cette facture
                $reglements = $facture->Reglements;

                // Vérifier s'il y a au moins deux règlements
                if ($reglements->count() > 1) {
                    // Récupérer l'avant-dernier règlement
                    $dernier_reglement = $reglements->reverse()->skip(1)->first();
                } else {
                    // Gérer le cas où il y a moins de deux règlements
                    $dernier_reglement = $facture->Reglements->first();
                }

                

            // dd($dernier_reglement);
    
            if ($dernier_reglement) {
                // Utiliser ResteDeMontantFacture du dernier règlement
                $reste_a_payer = $dernier_reglement->ResteDeMontantFacture;
            } else {
                // Si aucun règlement n'existe, utiliser le montant total de la facture
                $reste_a_payer = $facture->montant_totale;
            }
    
            // Calculer le nouveau reste à payer
            $nouveau_reste = $reste_a_payer - $montant_de_reglement;
    
            // Mettre à jour les données du règlement
            $reglement->update([
                'montant_de_reglement' => $montant_de_reglement,
                'Facture_ID' => $request->Facture_ID,
                'ID_Utilisateur_R_Client' => $request->ID_Utilisateur_R_Client,
                'ResteDeMontantFacture' => $nouveau_reste,
            ]);
    
            // Mettre à jour le statut de la facture si le montant restant est 0
            if ($nouveau_reste == 0) {
                $facture->update(['StatusReglement' => 'Terminée']);
            } else {
                $facture->update(['StatusReglement' => 'En cours']);
            }
    
            return redirect()->route('_Regl_.index')->with('message_success', 'Le règlement a été mis à jour avec succès.');
        } catch (\Exception $e) {
            // Log any unexpected exceptions for debugging
            // \Log::error($e);
            return back()->with('message_error', 'Une erreur est survenue lors de la mise à jour du règlement. Veuillez réessayer plus tard.');
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     try {
    //         // Trouver le règlement à supprimer
    //         $reglement = Reglement::findOrFail($id);
    
    //         // Récupérer l'ID de la facture associée à ce règlement
    //         $facture_id = $reglement->Facture_ID;
    
    //         // Supprimer le règlement
    //         $reglement->delete();
    
    //         // Vérifier s'il reste d'autres règlements pour cette facture
    //         $facture = Facture::findOrFail($facture_id);
    //         if ($facture->Reglements->isEmpty()) {
    //             // S'il n'y a plus de règlements, mettre à jour le statut de la facture à "En cours"
    //             $facture->update(['StatusReglement' => 'En cours']);
    //         }
    
    //         return back()->with('message_success', 'Le règlement a été supprimé avec succès.');
    //     } catch (\Exception $e) {
    //         // Log any unexpected exceptions for debugging
    //         // \Log::error($e);
    //         return back()->with('message_error', 'Une erreur est survenue lors de la suppression du règlement. Veuillez réessayer plus tard.');
    //     }
    // }

    public function destroy($id_reglement)
{
    try {
        // Trouver le règlement à supprimer
        $reglement = Reglement::findOrFail($id_reglement);

        // Récupérer l'ID de la facture associée à ce règlement
        $facture_id = $reglement->Facture_ID;

        // Supprimer le règlement
        $reglement->delete();

        // Vérifier s'il reste d'autres règlements pour cette facture
        $facture = Facture::findOrFail($facture_id);
        if ($facture->Reglements->isEmpty()) {
            // S'il n'y a plus de règlements, mettre à jour le statut de la facture à "En cours"
            $facture->update(['StatusReglement' => 'En cours']);
        } else {
            // S'il reste des règlements, vérifier si le montant restant est devenu zéro
            $montant_restant = $facture->montant_totale - $facture->Reglements->sum('montant_de_reglement');
            if ($montant_restant != 0) {
                // Si le montant restant est zéro, mettre à jour le statut de la facture à "En cours"
                $facture->update(['StatusReglement' => 'En cours']);
            }
        }

        return redirect()->route('_Regl_.index')->with('message_success', 'Le règlement a été supprimé avec succès.');
    } catch (\Exception $e) {
        // Log any unexpected exceptions for debugging
        // \Log::error($e);
        return back()->with('message_error', 'Une erreur est survenue lors de la suppression du règlement. Veuillez réessayer plus tard.');
    }
}

    


    // ce block pour les fcts personnalisées
    // public function fun_form_Regl(){
    //     // $administrateurs = Utilisateur::where('id_Role', 1)->get();
    //     // $fournisseurs = Utilisateur::where('id_Role', 10)->get();
    //     $clients = Utilisateur::where('id_Role', 3)->get();
    //     // $produits_data = Produit::with('photos')->get();
    //     $Factures_data = Facture::all();
    //     return view('page_add_regl', compact('Factures_data', 'clients'));
    // }

    // public function fun_form_Regl()
    // {
    //     $clients = Utilisateur::where('id_Role', 3)->get();
    //     $Factures_data = Facture::with('Reglements')->get();

    //     // Calculer le montant restant pour chaque facture
    //     foreach ($Factures_data as $facture) {
    //         $totalReglements = $facture->Reglements->sum('montant_de_reglement');
    //         // dd($totalReglements);
    //         $montant_restant = $facture->montant_totale - $totalReglements;
    //         dd($montant_restant);
    //     }

    //     return view('page_add_regl', compact('Factures_data', 'clients', 'montant_restant'));
    // }

    public function fun_form_Regl()
    {
        // $clients = Utilisateur::where('id_Role', 3)->get();
        // $clients = Utilisateur::where('id_Role', 3)
        //               ->whereHas('commandes_Utilisateur_R_Client')
        //               ->get();
        $clients = Utilisateur::where('id_Role', 3)
                        ->whereHas('commandes_Utilisateur_R_Client.factures')
                        ->get();
        $Factures_data = Facture::with('Reglements')->get();
        $factures_montant_restant = [];

        // Calculer le montant restant pour chaque facture
        foreach ($Factures_data as $facture) {
            if ($facture->Reglements->isNotEmpty()) {
                $totalReglements = $facture->Reglements->sum('montant_de_reglement');
                $montant_restant = $facture->montant_totale - $totalReglements;
            } else {
                $montant_restant = $facture->montant_totale;
            }
            $factures_montant_restant[$facture->id_facture] = $montant_restant;
        }

        return view('page_add_regl', compact('Factures_data', 'clients', 'factures_montant_restant'));
    }

    public function fun_clit_index($id_client_pg)
    {
        // Récupérer les stocks qui correspondent à l'ID de l'utilisateur fournisseur
        $Reglements_data = Reglement::where('ID_Utilisateur_R_Client', $id_client_pg)->get();
        
        // Retourner la vue avec les données des stocks
        return view('page_aff_regl', compact('Reglements_data'));
    }
}
