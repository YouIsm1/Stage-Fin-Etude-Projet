

@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            <!-- <h1>Hello { { session('utilisateur.nom') }} with the role is { { session('utilisateur.role.nom_de_role') }}</h1> -->
            <div class="index_role page_role_div">
                <div class="titre">
                    <h1>Voila tous les roles</h1>
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
                                    <td> ID du role </td>  
                                    <td> nom du role </td>  
                                    <td> description du role </td>  
                                    <td> la date d'ajout </td>  
                                    <td> la date de mise a jour </td>  
                                    <td colspan="2">Actions</td>
                                </tr>  
                            </thead>  
                            <tbody>  
                                @foreach($roles_data as $role_data)  
                                        <tr border="none">  
                                            <td> {{ $role_data -> id_Role }} </td>  
                                            <td> {{ $role_data -> nom_de_role }} </td>  
                                            <td> {{ $role_data -> description }} </td>  
                                            <!-- <td> { { $role_data -> price }} </td>   -->
                                            <td> {{ $role_data -> created_at }} </td>  
                                            <td> {{ $role_data -> updated_at }} </td>  
                                            <td >  
                                                <form action="{{ route('_role_.destroy', $role_data->id_Role) }}" method="post">  
                                                    @csrf  
                                                    @method('DELETE')  
                                                        <button class="btn btn_rst" type="submit">Supprimer</button>  
                                                </form>  
                                            </td>  
                                            <td >  
                                                <form action="{{ route('_role_.edit', $role_data->id_Role) }}" method="GET">  
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
                    <button class="btn btn_sbt"><a href=" {{ route('/form_role') }} "> Ajouter un Role </a></button>
                </div>
            </div>
        @else
            <p>Vous êtes pas autorisée pour entrer cette page.</p>
        @endif
    </div>
@endsection