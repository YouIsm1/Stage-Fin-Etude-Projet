
@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            <!-- <h1>Hello { { session('utilisateur.nom') }} with the role is { { session('utilisateur.role.nom_de_role') }}</h1> -->
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Ajouter un Role</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" action="{{ route('_role_.store') }}" method="POST">
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
                                        <label class="input_lable input_lable_s_btn" for="nom_de_role">Nom du Role :</label><br>
                                        <input class="input_lable Input_item input_lable_s_btn" type="text" name="nom_de_role" id="nom_de_role" placeholder="Entrer le nom du role" value="{{ old('nom_de_role') }}">
                                        @if ($errors->has('nom_de_role'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('nom_de_role') }}
                                            </div>
                                        @endif
                                        <!-- @ if(session('err_email_n_e'))
                                            <div class="alert_message alert_error">
                                                { { session('err_email_n_e') }}
                                            </div>
                                        @ endif -->
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="description">La description du Role :</label><br>
                                        <input class="input_lable Input_item input_lable_s_btn" type="text" name="description" id="role_description" placeholder="Entrer La description du Role" value="{{ old('role_description') }}">
                                        @if ($errors->has('description'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                        <!-- @ if(session('err_mto'))
                                            <div class="alert_message alert_error">
                                                { { session('err_mto') }}
                                            </div>
                                        @ endif -->
                                    </div>
                                    <div class="Div_email Div_btn_s" title="Actions">

                                        <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                                        <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Ajouter</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('_role_.index') }} "> Voir les Roles </a></button>
                    </div>
                </div>
        @else

            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
                <!-- <button class="btn btn_sbt"><a href=" { { route('_role_.index') }} "> Voir les Roles </a></button> -->
            </div>
        @endif
    </div>
@endsection
