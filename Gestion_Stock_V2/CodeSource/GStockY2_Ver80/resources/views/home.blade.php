

@extends('Layouts.master')
@section('ContentComp')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <div class="content_section">
        <!-- <h1>test</h1>
        @ if(session()->has('utilisateur'))
            <h1>Hello { { session('utilisateur.nom') }} with the role is { { session('utilisateur.role.nom_de_role') }}</h1>
        @ else
            <p>No user data available.</p>
        @ endif -->
        @if(session()->has('utilisateur'))
                <div class="page_role_div">

                    <div class="titre form_div">
                        <!-- <h2>Ajouter un Utilisateur</h2> -->
                        <!-- <h4 style="text-align: justify;"> -->
                        <h3>
                            Bonjour {{ session('utilisateur.nom') }} {{ session('utilisateur.prenom') }},
                            Vous êtes un {{ session('utilisateur.role.nom_de_role') }}.

                        </h3>
                    </div>
                    <div class="dparb">
                        <div class="titre form_div">
                            <h6>Vous pouvez modifier Vos informations depuis ce formulaire:</h6>
                        </div>
                        <div class="form_div">
                            <form class="form_item" method="Post" action="{{ route('home_update', session('utilisateur.id_Utilisateur')) }}">
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

                                        <label class="input_lable input_lable_s_btn" for="prenom">Prénom du l'utilisateur :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="prenom" id="prenom" placeholder="Entrer le prénom du l'utilisateur" value="{{ session('utilisateur.prenom') }}">
                                        @if ($errors->has('prenom'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('prenom') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">

                                        <label class="input_lable input_lable_s_btn" for="nom">Nom du l'utilisateur :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="nom" id="nom" placeholder="Entrer le nom du l'utilisateur" value="{{ session('utilisateur.nom') }}">
                                        @if ($errors->has('nom'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('nom') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">

                                        <label class="input_lable input_lable_s_btn" for="email">Email du l'utilisateur :</label><br>
                                        <input class="input_lable Input_item input_lable_s_btn" type="email" name="email" id="email" placeholder="Entrer l'email du l'utilisateur" value="{{ session('utilisateur.email') }}">
                                        @if ($errors->has('email'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="mot_de_passe">Mot de Passe :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="mot_de_passe" id="mot_de_passe" placeholder="Entrer le Mot de Passe" value="{{ session('utilisateur.mot_de_passe') }}">
                                        @if ($errors->has('mot_de_passe'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('mot_de_passe') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="id_Role">Le Role :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="id_Role" id="">
                                            <option value=" {{ session('utilisateur.role.id_Role') }} ">{{ session('utilisateur.role.nom_de_role') }}</option>
                                        </select>
                                        @if ($errors->has('id_Role'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('id_Role') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_email Div_btn_s" title="Actions">
                                        <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                                        <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Enregistrer</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" { { route('_user_.index') }} "> Voir les Utilisateurs </a></button>
                    </div> -->
                </div>
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
            </div>
        @endif

    </div>
@endsection
