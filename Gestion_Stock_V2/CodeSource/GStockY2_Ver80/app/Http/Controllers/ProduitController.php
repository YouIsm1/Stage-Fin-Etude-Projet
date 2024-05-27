<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// pour importer les models
use App\Models\Role;
use App\Models\Categorie;
use App\Models\Utilisateur;
use App\Models\Produit;
use App\Models\Photo_Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $produits_data = Produit::all();
        // $produits_data = Photo_Produit::all($);
        // return view('page_aff_prod', compact('produits_data'));

        // Récupérer tous les produits avec leurs photos associées
        $produits_data = Produit::with('photos')->get();
        // dd($produits_data);
        // Retourner la vue avec les données des produits
        return view('page_aff_prod', compact('produits_data'));
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
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'id_categorie' => 'required|exists:categories,id_categorie',
            'nom_1' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'nom_2' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'nom_3' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'nom_4' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ], [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'description.required' => 'La description du produit est obligatoire.',
            'quantite.required' => 'La quantité du produit est obligatoire.',
            'prix.required' => 'Le prix du produit est obligatoire.',
            'id_categorie.required' => 'La catégorie du produit est obligatoire.',
            'mimes' => 'Le fichier doit être une image (jpg, jpeg, png).',
            'max' => 'La taille de l\'image ne doit pas dépasser 2 Mo.',
            'required' => 'Ce Champ est obligatoire'
        ]);

        try {
            $produit = Produit::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'quantite' => $request->quantite,
                'prix' => $request->prix,
                'ID_Utilisateur_R_administrateur' => $request->ID_Utilisateur_R_administrateur,
                'id_categorie' => $request->id_categorie,
            ]);

            // Handle file uploads
            for ($i = 1; $i <= 4; $i++) {
                $file = $request->file('nom_' . $i);
                if ($file) {
                    $path = $file->store('images', 'public');
                    Photo_Produit::create([
                        'produit_id' => $produit->id_produit,
                        'nom' => $file->getClientOriginalName(),
                        'path' => $path,
                    ]);
                }
            }

            return redirect()->route('_prod_.index')->with('message_success', 'Produit ajouté avec succès.');
        } catch (\Exception $e) {
            // Log the exception message for debugging
            // \Log::error('Erreur lors de l\'ajout du produit : ' . $e->getMessage());
            dd($e);
            return redirect()->back()->withInput()->with('message_error', 'Une erreur est survenue lors de l\'ajout du produit. Veuillez réessayer.');
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
    public function destroy($id)
    {
        try {
            // Trouver le produit par son ID
            $produit = Produit::findOrFail($id);

            // Supprimer les photos associées
            foreach ($produit->photos as $photo) {
                // Supprimer le fichier du disque
                // \Storage::disk('public')->delete($photo->path);
                Storage::disk('public')->delete($photo->path);
                // Supprimer l'enregistrement de la photo
                $photo->delete();
            }

            // Supprimer le produit
            $produit->delete();

            return redirect()->route('_prod_.index')->with('message_success', 'Produit supprimé avec succès.');
        } catch (\Exception $e) {
            // Log the exception message for debugging
            // \Log::error('Erreur lors de la suppression du produit : ' . $e->getMessage());
            return redirect()->back()->with('message_error', 'Une erreur est survenue lors de la suppression du produit. Veuillez réessayer.');
        }
    }




    // ce bolck pour les fonctions personalissee
    public function fun_form_prod(){
        $categ_s_data = Categorie::all();
        return view('page_add_prod', compact('categ_s_data'));
    }

    public function fun_prod_Detailles($id_produit){

    }
}
