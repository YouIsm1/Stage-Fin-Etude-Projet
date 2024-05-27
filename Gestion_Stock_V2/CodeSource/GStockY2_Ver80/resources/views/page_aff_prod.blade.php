
@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            @if (isset($produits_data))
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h2>Voila tous les Produits</h2>
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
                                        <td> ID du Produit </td>
                                        <td> Nom du Produit </td>
                                        <td> Description du Produit </td>
                                        <td> Quantité </td>
                                        <td> Prix </td>
                                        <td> Administrateur</td>
                                        <td> Catégorie </td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <td colspan="3">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produits_data as $produit_data)
                                            <tr border="none">
                                                <td> {{ $produit_data -> id_produit }} </td>
                                                <td> {{ $produit_data -> nom }} </td>
                                                <td> {{ $produit_data -> description }} </td>
                                                <td> {{ $produit_data -> quantite }} </td>
                                                <td> {{ $produit_data -> prix }} </td>
                                                <td> {{ $produit_data -> utilisateur -> nom }} {{ $produit_data -> utilisateur -> prenom }} </td>
                                                <td> {{ $produit_data -> categorie -> nom }} </td>
                                                <td> {{ $produit_data -> created_at }} </td>
                                                <td> {{ $produit_data -> updated_at }} </td>
                                                <td >
                                                    <form action="{{ route('_prod_.destroy', $produit_data->id_produit) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button class="btn btn_rst" type="submit">Supprimer</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_prod_.edit', $produit_data->id_produit) }}" method="GET">
                                                        @csrf
                                                            <button class="btn btn_sbt" type="submit">Modifier</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_prod_Detailles', $produit_data->id_produit) }}" method="GET">
                                                        @csrf
                                                            <button class="btn btn_sbt" type="submit">Détailles</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td colspan="12">
                                                    <div class="di_images">
                                                        @ foreach($produit_data->photos as $photo)
                                                            <div class="di_image">
                                                                <img src="{ { url('storage/' . $photo->path) }}" alt="{ { $photo->nom }}">
                                                            </div>
                                                        @ endforeach
                                                    </div>
                                                </td>
                                            </tr> -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('form_prod') }} "> Ajouter un Produit </a></button>
                    </div>
                </div>
                @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                     <p>Il y a aucun Produit.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('form_prod') }} "> Ajouter un Produit </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
            </div>
        @endif
    </div>
@endsection
