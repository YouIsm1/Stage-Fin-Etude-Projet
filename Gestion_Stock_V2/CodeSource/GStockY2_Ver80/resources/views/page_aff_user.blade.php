

@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            @if (isset($users_data))
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h1>Voila tous les Utilisateurs</h1>
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
                                        <td> ID du utilisateur </td>
                                        <td> prenom du utilisateur </td>
                                        <td> nom du utilisateur </td>
                                        <td> l'email du utilisateur </td>
                                        <td> Mot de passe </td>
                                        <td> le role </td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <td colspan="2">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users_data as $user_data)
                                            <tr border="none">
                                                <td> {{ $user_data -> id_Utilisateur }} </td>
                                                <td> {{ $user_data -> prenom }} </td>
                                                <td> {{ $user_data -> nom }} </td>
                                                <td> {{ $user_data -> email }} </td>
                                                <td> {{ $user_data -> mot_de_passe }} </td>
                                                <td> {{ $user_data -> role -> nom_de_role }} </td>
                                                <td> {{ $user_data -> created_at }} </td>
                                                <td> {{ $user_data -> updated_at }} </td>
                                                <td >
                                                    <form action="{{ route('_user_.destroy', $user_data->id_Utilisateur) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button class="btn btn_rst" type="submit">Supprimer</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_user_.edit', $user_data->id_Utilisateur) }}" method="GET">
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
                        <button class="btn btn_sbt"><a href=" {{ route('form_user') }} "> Ajouter un Utilisateur </a></button>
                    </div>
                </div>
            @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                     <p>Il y a aucun utilisateur.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('form_user') }} "> Ajouter un Utilisateur </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous êtes pas autorisée pour entrer cette page.</p>
            </div>
        @endif
    </div>
@endsection
