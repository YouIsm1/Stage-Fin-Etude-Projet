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

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Stocks_data = Stock::all();
        return view('page_aff_stock', compact('Stocks_data'));
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

         // Messages de validation personnalisés
         $messages = [
            'ID_Utilisateur_R_administrateur.required' => 'L\'administrateur est requis.',
            'ID_Utilisateur_R_administrateur.exists' => 'L\'administrateur sélectionné n\'existe pas.',
            'ID_Utilisateur_R_Fournisseur.required' => 'Le fournisseur est requis.',
            'ID_Utilisateur_R_Fournisseur.exists' => 'Le fournisseur sélectionné n\'existe pas.',
            'ID_Produit.required' => 'Le produit est requis.',
            'ID_Produit.exists' => 'Le produit sélectionné n\'existe pas.',
            'Quantite.required' => 'La quantité est requise.',
            'Quantite.integer' => 'La quantité doit être un nombre entier.',
            'Quantite.min' => 'La quantité doit être au moins de 1.',
            'status.required' => 'Le statut est requis.',
            'status.in' => 'Le statut doit être soit "Entrant" soit "Sortant".',
        ];
    
        // Validation des données de la requête
        $request->validate([
            'ID_Utilisateur_R_administrateur' => 'required|exists:utilisateurs,id_Utilisateur',
            'ID_Utilisateur_R_Fournisseur' => 'required|exists:utilisateurs,id_Utilisateur',
            'ID_Produit' => 'required|exists:produits,ID_Produit',
            'Quantite' => 'required|integer|min:1',
            'status' => 'required|in:Entrant,Sortant',
        ], $messages);

        try{
        
            // Récupérer les données validées
            $data = $request->only([
                'ID_Utilisateur_R_administrateur',
                'ID_Utilisateur_R_Fournisseur',
                'ID_Produit',
                'Quantite',
                'status',
            ]);
        
            // Récupérer le produit correspondant
            $produit = Produit::findOrFail($data['ID_Produit']);
        
            // Ajuster la quantité du produit en fonction du type de stock
            if ($data['status'] === 'Entrant') {
                $produit->quantite += $data['Quantite'];
            } elseif ($data['status'] === 'Sortant') {
                if ($produit->quantite < $data['Quantite']) {
                    return redirect()->back()->with('message_error', 'Quantité insuffisante pour ce produit.')->withInput();
                }
                $produit->quantite -= $data['Quantite'];
            }
        
            // Sauvegarder les modifications du produit
            $produit->save();
        
            // Créer une nouvelle entrée de stock
            Stock::create([
                'ID_Utilisateur_R_administrateur' => $data['ID_Utilisateur_R_administrateur'],
                'ID_Utilisateur_R_Fournisseur' => $data['ID_Utilisateur_R_Fournisseur'],
                'ID_Produit' => $data['ID_Produit'],
                'Quantite' => $data['Quantite'],
                'status' => $data['status'],
            ]);
        
            // Retourner une réponse avec un message de succès
            return redirect()->route('_stock_.index')->with('message_success', 'Stock ajouté avec succès.');
        } catch (\Exception $e) {
            dd($e);
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
    public function edit($id_stock)
    {
        $Stock_data = Stock::find($id_stock);

        if (!$Stock_data) {
            return redirect()->route('_stock_.index')->with('message_error', 'Stock introuvable.');
        }

        // return view('page_edit_user', compact('user_data', 'roles_data'));

        $administrateurs = Utilisateur::where('id_Role', 1)->get();
        $fournisseurs = Utilisateur::where('id_Role', 10)->get();
        $produits_data = Produit::with('photos')->get();
        // dd($Stock_data);
        return view('page_edit_stock_2', compact('Stock_data', 'administrateurs', 'fournisseurs', 'produits_data'));
        // return view('page_edit_stock', compact('Stock_data', 'administrateurs', 'fournisseurs', 'produits_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_stock)
    {
        // Messages de validation personnalisés
        $messages = [
            'ID_Utilisateur_R_Fournisseur.required' => 'Le fournisseur est requis.',
            'ID_Utilisateur_R_Fournisseur.exists' => 'Le fournisseur sélectionné n\'existe pas.',
            'ID_Produit.required' => 'Le produit est requis.',
            'ID_Produit.exists' => 'Le produit sélectionné n\'existe pas.',
            'Quantite.required' => 'La quantité est requise.',
            'Quantite.integer' => 'La quantité doit être un nombre entier.',
            'Quantite.min' => 'La quantité doit être au moins de 1.',
            'status.required' => 'Le statut est requis.',
            'status.in' => 'Le statut doit être soit "Entrant" soit "Sortant".',
        ];
    
        // Validation des données de la requête
        $request->validate([
            'ID_Utilisateur_R_Fournisseur' => 'required|exists:utilisateurs,id_Utilisateur',
            'ID_Produit' => 'required|exists:produits,id_produit',
            'Quantite' => 'required|integer|min:1',
            'status' => 'required|in:Entrant,Sortant',
        ], $messages);
    
        try {
            // Récupérer les données validées
            $data = $request->only([
                'ID_Utilisateur_R_Fournisseur',
                'ID_Produit',
                'Quantite',
                'status',
            ]);
    
            // Récupérer les données de stock
            $stock = Stock::findOrFail($id_stock);
    
            // Récupérer le produit correspondant
            $produit = Produit::findOrFail($data['ID_Produit']);
    
            // Ajuster la quantité du produit en fonction du type de stock
            if ($stock->status !== $data['status']) {
                if ($data['status'] === 'Entrant') {
                    // $produit->quantite += $data['Quantite'] - $stock->Quantite;
                    $produit->quantite += $data['Quantite'] + $stock->Quantité;
                } elseif ($data['status'] === 'Sortant') {
                    if ($produit->quantite < $data['Quantite']) {
                        return redirect()->back()->with('message_error', 'Quantité insuffisante pour ce produit, sachant que la quantite totale de ce produit est : ' . $produit->quantite)->withInput();
                        // $produit->quantite = 0;
                    }
                    // $produit->quantite -= $data['Quantite'] - $stock->Quantite;
                    $produit->quantite -= $data['Quantite'] + $stock->Quantité;
                }
            } else {
                if ($data['status'] === 'Entrant') {
                    $produit->quantite += $data['Quantite'] - $stock->Quantité;
                    // $produit->quantite = $data['Quantite'];
                } elseif ($data['status'] === 'Sortant') {
                    if ($produit->quantite + $stock->Quantité < $data['Quantite']) {
                        return redirect()->back()->with('message_error', 'Quantité insuffisante pour ce produit, sachant que la quantite totale de ce produit est : ' . $produit->quantite)->withInput();
                        // $produit->quantite = 0;
                    }
                    $produit->quantite += $stock->Quantité - $data['Quantite'];
                    // $produit->quantite -= $stock->Quantite - $data['Quantite'];
                }
            }
    
            // Sauvegarder les modifications du produit
            $produit->save();
    
            // Mettre à jour les données de stock
            $stock->update([
                'ID_Utilisateur_R_Fournisseur' => $data['ID_Utilisateur_R_Fournisseur'],
                'ID_Produit' => $data['ID_Produit'],
                'Quantite' => $data['Quantite'],
                'status' => $data['status'],
            ]);
    
            // Retourner une réponse avec un message de succès
            return redirect()->route('_stock_.index')->with('message_success', 'Stock mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la mise à jour du stock. Veuillez réessayer.');
        }
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
            $stock = Stock::find($id_stock);
            $stock->delete();

            // Récupérer le produit correspondant
            $produit = Produit::findOrFail($stock->ID_Produit);
        
            // Ajuster la quantité du produit en fonction du type de stock
            if ($stock->status === 'Sortant') {
                $produit->quantite += $stock->Quantité;
            } elseif ($stock->status === 'Entrant') {
                if ($produit->quantite < $stock->Quantité) {
                    $produit->quantite = 0;
                }else{
                    $produit->quantite -= $stock->Quantité;
                }  
            }
        
            // Sauvegarder les modifications du produit
            $produit->save();

            return redirect()->route('_stock_.index')->with('message_success', 'Stock supprimé avec succès.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la suppression du stock. Veuillez réessayer.');
        }
    }

    // Ce block pour les fonctions personnelles
    public function fun_form_stock(){
        // $users_data = Utilisateur::all();
        $administrateurs = Utilisateur::where('id_Role', 1)->get();
        $fournisseurs = Utilisateur::where('id_Role', 10)->get();
        $produits_data = Produit::with('photos')->get();
        return view('page_add_stock', compact('administrateurs', 'fournisseurs', 'produits_data'));
    }
}
