

@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            @if (isset($categ_s_data))
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h2>Voila tous les Categories</h2>
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
                                        <td> ID de Catégorie </td>
                                        <td> nom de Catégorie </td>
                                        <td> description de Catégorie </td>
                                        <td> Nom, Prénom d'administrateur</td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <td colspan="2">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categ_s_data as $categ_data)
                                            <tr border="none">
                                                <td> {{ $categ_data -> id_categorie }} </td>
                                                <td> {{ $categ_data -> nom }} </td>
                                                <td> {{ $categ_data -> description }} </td>
                                                <td> {{ $categ_data -> utilisateur -> nom }} {{ $categ_data -> utilisateur -> prenom }} </td>
                                                <td> {{ $categ_data -> created_at }} </td>
                                                <td> {{ $categ_data -> updated_at }} </td>
                                                <td >
                                                    <form action="{{ route('_cate_.destroy', $categ_data->id_categorie) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button class="btn btn_rst" type="submit">Supprimer</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_cate_.edit', $categ_data->id_categorie) }}" method="GET">
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
                        <button class="btn btn_sbt"><a href=" {{ route('form_cate') }} "> Ajouter un Role </a></button>
                    </div>
                </div>
                @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                     <p>Il y a aucun role.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('form_cate') }} "> Ajouter un Role </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous êtes pas autorisée pour entrer cette page.</p>
            </div>
        @endif
    </div>
@endsection
