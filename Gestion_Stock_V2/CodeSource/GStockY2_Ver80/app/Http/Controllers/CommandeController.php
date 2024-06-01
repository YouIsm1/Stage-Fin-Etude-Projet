<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// pour importer les models
use App\Models\Role;
use App\Models\Utilisateur;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Photo_Produit;
use App\Models\Stock;
use App\Models\Commande;


class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Commandes_data = Commande::all();
        return view('page_aff_comm', compact('Commandes_data'));
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
        // Valider les données du formulaire avec des messages d'indication personnalisés
        $validator = Validator::make($request->all(), [
            'ID_Utilisateur_R_Client' => 'required|exists:utilisateurs,id_Utilisateur',
        ], [
            'ID_Utilisateur_R_Client.required' => 'Le champ client est obligatoire.',
            'ID_Utilisateur_R_Client.exists' => 'Le client sélectionné n\'existe pas.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Créer la commande
        $commande = new Commande();
        // $commande->ID_Utilisateur_R_Vendeur_Admin = session('utilisateur.id_Utilisateur');
        $commande->ID_Utilisateur_R_Vendeur_Admin = $request->input('ID_Utilisateur_R_administrateur');
        $commande->ID_Utilisateur_R_Client = $request->input('ID_Utilisateur_R_Client');
        $commande->description = $request->input('description', ''); // Description non obligatoire
        $commande->save();

        // Rediriger avec un message de succès
        return redirect()->route('_Comm_.index')->with('message_success', 'Commande ajoutée avec succès.');
        // return redirect()->back()->with('message_success', 'Commande ajoutée avec succès.');
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
    public function edit($id_Commande)
    {
        $Commande_data = Commande::find($id_Commande);

        if (!$Commande_data) {
            return redirect()->route('_Comm_.index')->with('message_error', 'Commande introuvable.');
        }

        // return view('page_edit_user', compact('user_data', 'roles_data'));

        // $administrateurs = Utilisateur::where('id_Role', 1)->get();
        // $fournisseurs = Utilisateur::where('id_Role', 10)->get();
        // $produits_data = Produit::with('photos')->get();
        // dd($Stock_data);
        // return view('page_edit_stock_2', compact('Stock_data', 'administrateurs', 'fournisseurs', 'produits_data'));
        
        $clients = Utilisateur::where('id_Role', 3)->get();
        return view('page_edit_comm', compact('clients', 'Commande_data'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_Commande)
    {
        // Valider les données du formulaire avec des messages d'indication personnalisés
        $validator = Validator::make($request->all(), [
            'ID_Utilisateur_R_Client' => 'required|exists:utilisateurs,id_Utilisateur',
            'description' => 'nullable|string|max:255',
        ], [
            'ID_Utilisateur_R_Client.required' => 'Le champ client est obligatoire.',
            'ID_Utilisateur_R_Client.exists' => 'Le client sélectionné n\'existe pas.',
            'description.max' => 'La description ne peut pas dépasser 255 caractères.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Trouver la commande par son id
        $commande = Commande::find($id_Commande);
    
        if (!$commande) {
            return redirect()->route('_Comm_.index')->with('message_error', 'Commande introuvable.');
        }
    
        // Mettre à jour les données de la commande
        $commande->ID_Utilisateur_R_Client = $request->input('ID_Utilisateur_R_Client');
        $commande->description = $request->input('description', ''); // Description non obligatoire
        $commande->save();
    
        // Rediriger avec un message de succès
        return redirect()->route('_Comm_.index')->with('message_success', 'Commande mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_stock)
    {
        try {
            $Commande = Commande::find($id_stock);
            $Commande->delete();

            // // Récupérer le produit correspondant
            // $produit = Produit::findOrFail($stock->ID_Produit);
        
            // // Ajuster la quantité du produit en fonction du type de stock
            // if ($stock->status === 'Sortant') {
            //     $produit->quantite += $stock->Quantite;
            // } elseif ($stock->status === 'Entrant') {
            //     if ($produit->quantite < $stock->Quantite) {
            //         $produit->quantite = 0;
            //     }else{
            //         $produit->quantite -= $stock->Quantite;
            //     }  
            // }
        
            // // Sauvegarder les modifications du produit
            // $produit->save();

            // return redirect()->route('_stock_.index')->with('message_success', 'Stock supprimé avec succès.');
            return redirect()->back()->with('message_success', 'Commande supprimé avec succès.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la suppression du Commande. Veuillez réessayer.');
        }
    }

    // Ce block pour les fonctions personnelles
    public function fun_form_Comm(){
        // $users_data = Utilisateur::all();
        // $administrateurs = Utilisateur::where('id_Role', 1)->get();
        $clients = Utilisateur::where('id_Role', 3)->get();
        // $produits_data = Produit::with('photos')->get();
        // return view('page_add_comm', compact('administrateurs', 'fournisseurs', 'produits_data'));
        return view('page_add_comm', compact('clients'));
    }
}
