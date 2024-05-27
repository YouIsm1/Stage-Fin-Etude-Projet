<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categ_s_data = Categorie::all();
        return view('page_aff_cate', compact('categ_s_data'));
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
            // Validation des données du formulaire
            $request->validate([
                'nom' => 'required|min:4|unique:categories,nom',
                // 'description' => 'required|min:4',
            ], [
                'nom.required' => 'Le nom de la catégorie est requis.',
                'nom.min' => 'Le nom de la catégorie doit comporter au moins 4 caractères.',
                'nom.unique' => 'Le nom de la catégorie doit être unique. Alors, a déjà été pris.',
                // 'description.required' => 'La description de la catégorie est requise.',
                // 'description.min' => 'La description de la catégorie doit comporter au moins 4 caractères.',
            ]);
            // Création d'une nouvelle catégorie
            try {
                $categorie = new Categorie();
                $categorie->nom = $request->nom;
                // $categorie->description = $request->description;
                if ($request->has('description')) {
                    $categorie->description = $request->description;
                }
                $categorie->ID_Utilisateur_R_administrateur = $request->ID_Utilisateur_R_administrateur; // L'utilisateur qui a ajouté la catégorie
                $categorie->save();
                return redirect()->route('_cate_.index')->with('message_success', 'La catégorie a été ajoutée avec succès.');
            } catch (\Exception $e) {
                dd($e);
                return redirect()->back()->with('message_error', 'Échec de l\'ajout de la catégorie.');
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
    public function edit($id_categorie)
    {
        $cate_data = Categorie::find($id_categorie);

        if (!$cate_data) {
            // Gérer le cas où le rôle n'est pas trouvé
            return redirect()->route('_cate_.index')->with('message_error', 'Categorie introuvable.');
        }

        return view('page_edit_cate', compact('cate_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_categorie)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required|min:4|unique:categories,nom,' . $id_categorie . ',id_categorie',
            // 'description' => 'required|min:4',
        ], [
            'nom.required' => 'Le nom de la catégorie est requis.',
            'nom.min' => 'Le nom de la catégorie doit comporter au moins 4 caractères.',
            'nom.unique' => 'Le nom de la catégorie doit être unique. Alors, a déjà été pris.',
            // 'description.required' => 'La description de la catégorie est requise.',
            // 'description.min' => 'La description de la catégorie doit comporter au moins 4 caractères.',
        ]);

        // Mise à jour des données de la catégorie
        try {
            $categorie = Categorie::find($id_categorie);
            $categorie->nom = $request->nom;
            // $categorie->description = $request->description;
            if ($request->has('description')) {
                $categorie->description = $request->description;
            }
            $categorie->save();

            return redirect()->route('_cate_.index')->with('message_success', 'La catégorie a été mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', 'Échec de la mise à jour de la catégorie.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_categorie)
    {
        try {
            $categorie = Categorie::find($id_categorie);
            $categorie->delete();
            return redirect()->route('_cate_.index')->with('message_success', 'L\'enregistrement a été supprimé');
        } catch (\Exception $e) {
            return redirect()->route('_cate_.index')->with('message_error', 'Échec de la suppression de Categorie');
        }
    }

    // Ce block pour les fonctions personnelles
    public function form_categ()
    {
        return view('page_add_cate');
    }
}
