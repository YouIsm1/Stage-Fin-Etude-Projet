

@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            @if(isset($user_data))
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Modifier un Utilisateur</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                        <form class="form_item" method="Post" action="{{ route('_user_.update', $user_data->id_Utilisateur) }}">
                                @if(session('message_success'))
                                    <div class="alert_message alert_message_role alert_succes">
                                        {{ session('message_success') }}
                                    </div>
                                @endif
                                @if(session('message_error'))
                                    <div class="alert_message alert_message_role alert_error">
                                        {{ session('message_error') }}
                                    </div>
                                @endif
                                @csrf
                                @method('PUT')
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="prenom">Prénom du utilisateur :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="prenom" id="prenom" placeholder="Entrer le prénom du utilisateur" value="{{ $user_data -> prenom }}">
                                        @if ($errors->has('prenom'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('prenom') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="nom">Nom du utilisateur :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="nom" id="nom" placeholder="Entrer le nom du utilisateur" value="{{ $user_data -> nom }}">
                                        @if ($errors->has('nom'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('nom') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="email">Email du utilisateur :</label><br>
                                        <input class="input_lable Input_item input_lable_s_btn" type="email" name="email" id="email" placeholder="Entrer l'email du utilisateur" value="{{ $user_data -> email }}">
                                        @if ($errors->has('email'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="mot_de_passe">Mot de Passe :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="mot_de_passe" id="mot_de_passe" placeholder="Entrer le Mot de Passe" value="{{ $user_data -> mot_de_passe }}">
                                        @if ($errors->has('mot_de_passe'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('mot_de_passe') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="id_Role">Le Role :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="id_Role" id="">
                                            @if (isset($roles_data))
                                                <option value="">Choisir un rôle</option>
                                                @foreach($roles_data as $role_data)
                                                    <option value="{{ $role_data->id_Role }}"
                                                        @if(isset($user_data) && $user_data->id_Role == $role_data->id_Role) selected @endif>
                                                        {{ $role_data->nom_de_role }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">--Il n'y a aucun rôle--</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('id_Role'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('id_Role') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_email Div_btn_s" title="Actions">
                                        <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Enregistrer</button>
                                        <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('_user_.index') }} "> Voir les Utilisateurs </a></button>
                    </div>
                </div>
            @else
                <p>Il y a aucune donee pour Utilisateur.</p>
            @endif
        @else
            <p>Vous êtes pas autorisée pour entrer cette page.</p>
        @endif
    </div>
@endsection
