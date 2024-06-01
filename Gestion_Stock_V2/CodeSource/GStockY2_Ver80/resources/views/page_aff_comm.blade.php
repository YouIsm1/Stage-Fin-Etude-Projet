



@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2))
            @if (isset($Commandes_data))
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h1>Voila tous les Commandes</h1>
                    </div>
                    <div class="dparb dpafrb">
                        <div class="table_div">
                            @if(session('message_success'))
                                <div class="alert_message alert_succes">
                                    {{ session('message_success') }}
                                </div>
                            @endif

                            @if(session('message_error'))
                                <div class="alert_message alert_error">
                                    {{ session('message_error') }}
                                </div>
                            @endif
                            <table class="table_item" border="1px solid white">
                                <thead>
                                    <tr>
                                        <td> ID du Commande </td>
                                        <td> Gestionnaire </td>
                                        <td> Le Client </td>
                                        <td> description du Commande </td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <td colspan="2">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Commandes_data as $Commande_data)
                                            <tr border="none">
                                                <td> {{ $Commande_data -> id_Commande }} </td>
                                                <!-- <td> { { $Commande_data -> ID_Utilisateur_R_Vendeur_Admin }} </td> -->
                                                <td> {{ $Commande_data -> Utilisateur_R_Vendeur_Admin -> nom }} {{ $Commande_data -> Utilisateur_R_Vendeur_Admin -> prenom }} </td>
                                                <!-- <td> { { $Commande_data -> ID_Utilisateur_R_Client }} </td> -->
                                                <td> {{ $Commande_data -> Utilisateur_R_Client -> nom }} {{ $Commande_data -> Utilisateur_R_Client -> prenom }} </td>
                                                <td> {{ $Commande_data -> description }} </td>
                                                <td> {{ $Commande_data -> created_at }} </td>
                                                <td> {{ $Commande_data -> updated_at }} </td>
                                                <td >
                                                    <form action="{{ route('_Comm_.destroy', $Commande_data -> id_Commande) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button class="btn btn_rst" type="submit">Supprimer</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_Comm_.edit', $Commande_data -> id_Commande) }}" method="GET">
                                                        @csrf
                                                            <button class="btn btn_sbt" type="submit">Modifier</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('form_Comm') }} "> Ajouter un Commande </a></button>
                    </div>
                </div>
                @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                     <p>Il y a aucun Commande.</p>
                     <button class="btn btn_sbt"><a href=" {{ route('form_Comm') }} "> Ajouter un Commande </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous êtes pas autorisée pour entrer cette page.</p>
            </div>
        @endif
    </div>
@endsection
