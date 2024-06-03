




@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 10))
            @if (isset($Factures_data) && Count($Factures_data) >= 1)
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h2>Voila tous les Factures</h2>
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
                                        <td> ID de facture </td>
                                        <td> ID du Commande </td>
                                        <td> Montant Totale en DH </td>
                                        <td> Status </td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <td colspan="2">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Factures_data as $Facture_data)
                                            <tr border="none">
                                                <td> {{ $Facture_data -> id_facture }} </td>
                                                <td> {{ $Facture_data -> commande_id }} </td>
                                                <td> {{ $Facture_data -> montant_totale }} </td>
                                                <td> {{ $Facture_data -> StatusReglement }} </td>
                                                <td> {{ $Facture_data -> created_at }} </td>
                                                <td> {{ $Facture_data -> updated_at }} </td>
                                                <td >
                                                    <form action="{{ route('_Fact_.destroy', $Facture_data->id_facture) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button class="btn btn_rst" type="submit">Supprimer</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_Fact_.edit', $Facture_data->id_facture) }}" method="GET">
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
                        <button class="btn btn_sbt"><a href=" {{ route('form_stock') }} "> Ajouter une Facture </a></button>
                    </div>
                </div>
                @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                     <p>Il y a aucune Facture.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('form_stock') }} "> Ajouter une Facture </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
            </div>
        @endif
    </div>
@endsection
