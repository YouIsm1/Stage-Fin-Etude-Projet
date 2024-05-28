


@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            @if (isset($Stocks_data) && Count($Stocks_data) >= 1)
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h2>Voila tous les Stocks</h2>
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
                                        <td> ID du Stock </td>
                                        <td> Nom du Produit </td>
                                        <td> Administrateur </td>
                                        <td> Fournisseur </td>
                                        <td> Quantité </td>
                                        <td> Status </td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <td colspan="2">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Stocks_data as $Stock_data)
                                            <tr border="none">
                                                <td> {{ $Stock_data -> id_stock }} </td>
                                                <td> {{ $Stock_data -> produit -> nom }} </td> 
                                                <td> {{ $Stock_data -> Utilisateur_R_administrateur -> nom }} {{ $Stock_data -> Utilisateur_R_administrateur -> prenom }} </td>
                                                <td> {{ $Stock_data -> Utilisateur_R_Fournisseur -> nom }} {{ $Stock_data -> Utilisateur_R_Fournisseur -> prenom }} </td>
                                                <td> {{ $Stock_data -> Quantite }} </td>
                                                <td> {{ $Stock_data -> status }} </td>
                                                <!-- <td> { { $Stock_data -> categorie -> nom }} </td> -->
                                                <td> {{ $Stock_data -> created_at }} </td>
                                                <td> {{ $Stock_data -> updated_at }} </td>
                                                <td >
                                                    <form action="{{ route('_stock_.destroy', $Stock_data->id_stock) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button class="btn btn_rst" type="submit">Supprimer</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_stock_.edit', $Stock_data->id_stock) }}" method="GET">
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
                        <button class="btn btn_sbt"><a href=" {{ route('form_stock') }} "> Ajouter un Stock </a></button>
                    </div>
                </div>
                @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                     <p>Il y a aucun Stock.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('form_stock') }} "> Ajouter un Stock </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
            </div>
        @endif
    </div>
@endsection
