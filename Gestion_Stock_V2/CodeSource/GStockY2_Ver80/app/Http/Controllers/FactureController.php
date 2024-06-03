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
}
