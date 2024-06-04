






@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2 || session('utilisateur.role.id_Role') == 3))
            @if (isset($Reglements_data) && Count($Reglements_data) >= 1)
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h2>Voila tous les Règlements</h2>
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
                                        <td> ID de Règlement </td>
                                        <td> ID de Facture </td>
                                        <td> Client </td>
                                        <td> Gestionnaire </td>
                                        <td> Montant Règlement en DH </td>
                                        <td> Le reste du Montant de Facture en DH </td>
                                        <td> La date du Règlement </td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <!-- <td colspan="2">Actions</td> -->
                                        <!-- <td colspan="1">Actions</td> -->
                                        @if (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2)
                                            <td colspan="2">Actions</td>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Reglements_data as $Reglement_data)
                                            <tr border="none">
                                                <td> {{ $Reglement_data -> id_reglement }} </td>
                                                <td> {{ $Reglement_data -> Facture_ID }} </td>
                                                <td> {{ $Reglement_data -> Utilisateur_R_Client -> nom }} {{ $Reglement_data -> Utilisateur_R_Client -> prenom }} </td>
                                                <td> {{ $Reglement_data -> Utilisateur_R_Vendeur_Admin -> nom }} {{ $Reglement_data -> Utilisateur_R_Vendeur_Admin -> prenom }} </td>
                                                <td> {{ $Reglement_data -> montant_de_reglement }} </td>
                                                <td> {{ $Reglement_data -> ResteDeMontantFacture }} </td>
                                                <td> {{ $Reglement_data -> date_reglement }} </td>
                                                <!-- <td> { { $Reglement_data -> StatusReglement }} </td> -->
                                                <td> {{ $Reglement_data -> created_at }} </td>
                                                <td> {{ $Reglement_data -> updated_at }} </td>
                                                @if (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2)
                                                    <td >
                                                        <form action="{{ route('_Regl_.destroy', $Reglement_data->id_reglement) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                                <button class="btn btn_rst" type="submit">Supprimer</button>
                                                        </form>
                                                    </td>
                                                    <td >
                                                        <form action="{{ route('_Regl_.edit', $Reglement_data->id_reglement) }}" method="GET">
                                                            @csrf
                                                                <button class="btn btn_sbt" type="submit">Modifier</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2)
                        <!-- <td colspan="2">Actions</td> -->
                        <div class="page_role_div dparb dpafrb btn_add_role_link">
                            <button class="btn btn_sbt"><a href=" {{ route('form_Regl') }} "> Ajouter un Reglement </a></button>
                        </div>
                    @endif
                </div>
                @else
                @if (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2)
                    <!-- <td colspan="2">Actions</td> -->
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                         <p>Il y a aucune Reglement.</p>
                        <button class="btn btn_sbt"><a href=" {{ route('form_Regl') }} "> Ajouter un Reglement </a></button>
                    </div>
                @else
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                         <p>Il y a aucune Reglement pour vous.</p>
                        <!-- <button class="btn btn_sbt"><a href=" {{ route('form_Regl') }} "> Ajouter un Reglement </a></button> -->
                    </div>
                @endif
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
            </div>
        @endif
    </div>
@endsection
