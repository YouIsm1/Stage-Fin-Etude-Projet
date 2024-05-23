
@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        <div class="page_role_div">
            <div class="titre">
                <h2>Ajouter un Role</h2>
            </div>
            <div class="dparb">
                <div class="form_div">
                    <form action="{{ route('_role_.store') }}" method="POST">
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
                        @csrf
                            <div class="Div_role_name Div_email">
                                <label class="input_lable input_lable_s_btn" for="nom_de_role">Nom du Role :</label><br>
                                <input class="input_lable Input_item input_lable_s_btn" type="text" name="nom_de_role" id="email" placeholder="Entrer l'email" value="{{ old('email') }}">
                                @if ($errors->has('nom_de_role'))
                                    <div class="alert_message alert_error">
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
                                <input class="input_lable Input_item input_lable_s_btn" type="text" name="description" id="role_description" placeholder="Entrer le mot de passe" value="{{ old('role_description') }}">
                                @if ($errors->has('description'))
                                    <div class="alert_message alert_error">
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
                                <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Ajouter</button>
                                <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection