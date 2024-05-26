<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// pour importer les models
use App\Models\Role;
use App\Models\Utilisateur;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_data = Utilisateur::all();
        return view('page_aff_user', compact('users_data'));
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
            'prenom' => 'required|min:4',
            'nom' => 'required|min:4',
            'email' => 'required|email|unique:utilisateurs,email',
            'mot_de_passe' => 'required|min:4',
            'id_Role' => 'required|exists:roles,id_Role',
        ], [
            'prenom.required' => 'Le champ du prénom est requis.',
            'prenom.min' => 'Le prenom doit comporter au moins 4 caractères.',
            'nom.required' => 'Le champ du nom est requis.',
            'nom.min' => 'Le nom doit comporter au moins 4 caractères.',
            'email.required' => 'Le champ de l\'email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà pris.',
            'mot_de_passe.required' => 'Le champ du mot de passe est requis.',
            'mot_de_passe.min' => 'Le mot de passe doit comporter au moins 4 caractères.',
            'id_Role.required' => 'Le champ du rôle est requis.',
            'id_Role.exists' => 'Le rôle sélectionné est invalide.',
        ]);

        try {
            $user = new Utilisateur;
            $user->prenom = $request->get('prenom');
            $user->nom = $request->get('nom');
            $user->email = $request->get('email');
            // $user->mot_de_passe = bcrypt($request->get('mot_de_passe')); // Encrypt the password
            $user->mot_de_passe = $request->get('mot_de_passe'); // Encrypt the password
            $user->id_Role = $request->get('id_Role');
            $user->save();

            return redirect()->route('_user_.index')->with('message_success', 'L\'utilisateur a été ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', 'Échec de l\'ajout de l\'utilisateur.');
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
    public function edit($id_Utilisateur)
    {
        $roles_data = Role::all();
        $user_data = Utilisateur::find($id_Utilisateur);

        if (!$user_data) {
            // Gérer le cas où le rôle n'est pas trouvé
            return redirect()->route('_user_.index')->with('message_error', 'utilisateur introuvable.');
        }

        return view('page_edit_user', compact('user_data', 'roles_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_Utilisateur)
    {
        $request->validate([
            'prenom' => 'required|min:4',
            'nom' => 'required|min:4',
            'email' => 'required|email|unique:utilisateurs,email,' . $id_Utilisateur . ',id_Utilisateur',
            'mot_de_passe' => 'nullable|min:4',
            'id_Role' => 'required|exists:roles,id_Role',
        ], [
            'prenom.required' => 'Le champ du prénom est requis.',
            'prenom.min' => 'Le prenom doit comporter au moins 4 caractères.',
            'nom.required' => 'Le champ du nom est requis.',
            'nom.min' => 'Le nom doit comporter au moins 4 caractères.',
            'email.required' => 'Le champ de l\'email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà pris.',
            'mot_de_passe.min' => 'Le mot de passe doit comporter au moins 4 caractères.',
            'id_Role.required' => 'Le champ du rôle est requis.',
            'id_Role.exists' => 'Le rôle sélectionné est invalide.',
        ]);

        try {
            $user = Utilisateur::find($id_Utilisateur);
            if (!$user) {
                return redirect()->route('_user_.index')->with('message_error', 'Utilisateur introuvable.');
                // return redirect()->back()->with('message_error', 'Utilisateur introuvable.');
            }

            $user->prenom = $request->get('prenom');
            $user->nom = $request->get('nom');
            $user->email = $request->get('email');
            if ($request->filled('mot_de_passe')) {
                // $user->mot_de_passe = bcrypt($request->get('mot_de_passe'));
                $user->mot_de_passe = $request->get('mot_de_passe');
            }
            $user->id_Role = $request->get('id_Role');
            $user->save();

            return redirect()->route('_user_.index')->with('message_success', 'L\'utilisateur a été mis à jour avec succès.');
            // return redirect()->back()->with('message_success', 'L\'utilisateur a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', 'Échec de la mise à jour de l\'utilisateur.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_Utilisateur)
    {
        try {
            $utilisateur = Utilisateur::find($id_Utilisateur);
            $utilisateur->delete();
            return redirect()->route('_user_.index')->with('message_success', 'L\'enregistrement a été supprimé');
        } catch (\Exception $e) {
            return redirect()->route('_user_.index')->with('message_error', 'Échec de la suppression d\'utilisateur');
        }
    }

    // Ce block pour les fonctions personnelles
    public function aff_form_user()
    {
        $roles_data = Role::all();
        return view('page_add_user', compact('roles_data'));
    }
}
