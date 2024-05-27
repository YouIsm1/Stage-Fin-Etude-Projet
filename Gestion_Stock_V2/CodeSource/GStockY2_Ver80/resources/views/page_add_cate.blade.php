
@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Ajouter une Categorie</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" action="{{ route('_cate_.store') }}" method="POST">
                                <input name="ID_Utilisateur_R_administrateur" type="number" value="{{ session('utilisateur.id_Utilisateur') }}" hidden>
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
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="nom">Nom de Catégorie :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="nom" id="nom" placeholder="Entrer le nom de Catégorie" value="{{ old('nom') }}">
                                        @if ($errors->has('nom'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('nom') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="description">La description de Catégorie :</label><br>
                                        <input class="input_lable Input_item input_lable_s_btn" type="text" name="description" id="role_description" placeholder="Entrer La description de Catégorie" value="{{ old('description') }}">
                                        @if ($errors->has('description'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_email Div_btn_s" title="Actions">
                                        <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Ajouter</button>
                                        <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('_cate_.index') }} "> Voir les Categories </a></button>
                    </div>
                </div>
        @else
            <p>Vous este pas autorisée.</p>
        @endif
    </div>
@endsection
