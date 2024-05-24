<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            return redirect('/test2')->with('message_success', 'Authentification réussie!');
        }
    }

    // public function test2(Request $request)
    // {
    //     // $utilisateur = session('utilisateur');
    //     // return view('test2', ['utilisateur' => $utilisateur]);

    //     // return view('test2');
    // }

    public function deconnnecter_fun(Request $request){
        $request->session()->flush();
        // Auth::logout(); // Déconnecte l'utilisateur
        return redirect('/');
    }    

}
