<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Role;
use App\Models\Utilisateur;

class AuthentificationController extends Controller
{
    public function AuthenFun(Request $request){
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required|min:4',
        ], [
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'mot_de_passe.required' => 'Le champ mot de passe est requis.',
            'mot_de_passe.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
        ]);

        // $utilisateur = Utilisateur::where('email', $request->email)
        //                 ->where('mot_de_passe', $request->mot_de_passe)
        //                 ->first();

        // if ($utilisateur) {
        //     return redirect('/')->with('success', 'Authentification réussie!');
        // } else {
        //     return back()->withErrors(['email' => 'Les informations d\'identification ne sont pas correctes.']);
        // }

        $utilisateur = Utilisateur::where('email', $request->email)->first();

        // if (!$utilisateur) {
        //     return back()->with(['err_email_n_e' => 'Ce email n\'existe pas dans la base de données.', 'email' => $request->email]);
        //     // return back()->with('err_email_n_e', 'Ce email n\'existe pas dans la base de données.');
        // } elseif ($utilisateur->mot_de_passe != $request->mot_de_passe) {
        //     return back()->with(['err_mot' => 'L\'email existe dans la base de données mais le mot de passe est incorrect.', 'email' => $request->email, 'mot_de_passe' => $request->mot_de_passe]);
        //     // return back()->with('err_mot', 'L\'email existe dans la base de données mais le mot de passe est incorrect.');
        // } else {
        //     return redirect('/')->with('message_success', 'Authentification réussie!');
        // }

        if (!$utilisateur) {
            return back()->withErrors(['email' => 'Ce email n\'existe pas dans la base de données.'])->withInput();
        } elseif ($utilisateur->mot_de_passe != $request->mot_de_passe) {
            return back()->withErrors(['mot_de_passe' => 'L\'email existe dans la base de données mais le mot de passe est incorrect.'])->withInput();
        } else {
            // Auth::login($utilisateur);
            // return redirect('/')->with('message_success', 'Authentification réussie!');
            // return redirect('/test2')->with(['message_success' => 'Authentification réussie!', 'utilisateur' => $utilisateur]);
            Session::put('utilisateur', $utilisateur);
            return redirect('home')->with('message_success', 'Authentification réussie!');
        }
    }

    // public function home_fun(Request $request)
    // {

    //     // $utilisateur = session('utilisateur');
    //     $role
    //     return view('home', ['utilisateur' => $utilisateur]);

    //     return view('home');
    // }

    public function deconnnecter_fun(Request $request){
        $request->session()->flush();
        // Auth::logout(); // Déconnecte l'utilisateur
        return redirect('/');
    }

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
                // return redirect()->route('_user_.index')->with('message_error', 'Utilisateur introuvable.');
                return redirect()->back()->with('message_error', 'Utilisateur introuvable.');
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

            Session::put('utilisateur', $user);
            // return redirect()->route('_user_.index')->with('message_success', 'L\'utilisateur a été mis à jour avec succès.');
            return redirect()->back()->with('message_success', 'L\'utilisateur a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', 'Échec de la mise à jour de l\'utilisateur.');
        }
    }

}
