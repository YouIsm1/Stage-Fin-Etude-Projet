<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// cella pour importer les models
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'nom_de_role' => 'required|unique:Roles',
            // 'role_description' => 'required|unique:Role',
        ], [
            'nom_de_role.required' => 'Le champ du rôle est requis.',
            'nom_de_role.unique' => 'Le rôle a déjà été pris.',
        ]);
  

        try {
            // Create a new utilisateur instance and save the data
            $role = new Role;
            $role->nom_de_role = $request->get('nom_de_role');
            // $role->description = $request->has('description') ? $request->description : '';
            // $role->description = $request->get('role_description');
            if ($request->has('description')) {
                $role->description = $request->description;
            }
            $role->save();
    
            // Flash a success message to the session
        //     return redirect()->back()->with('message_success', 'Le role ajoutee avec succees');
        // } catch (\Exception $e) {
        //     // Flash an error message to the session
        //     dd($e);
        //     return redirect()->back()->with('message_error', 'echec d\'ajputer le role');
        // }
            return redirect()->back()->with('message_success', 'Le rôle a été ajouté avec succès.');
        } catch (\Exception $e) {
            // Flash an error message to the session
            dd($e);
            return redirect()->back()->with('message_error', 'Échec de l\'ajout du rôle.');
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
        //
    }
}
