

@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2))
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Ajouter une Facture</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" action="{{ route('_Fact_.store') }}" method="POST">
                                <input name="ID_Utilisateur_R_administrateur" type="number" value="{{ session('utilisateur.id_Utilisateur') }}" hidden>
                                <div class="Div_description_role Div_email Div_password">
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
                                </div>
                                @csrf
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="commande_id">La Commande :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="commande_id">
                                            @if (isset($Commandes_data) && Count($Commandes_data) >= 1)
                                                <option value=""> Choisir une Commande </option>
                                                @foreach($Commandes_data as $Commande_data)
                                                    <option value=" {{ $Commande_data->id_Commande }} "> {{ $Commande_data->id_Commande }}  </option>
                                                @endforeach
                                            @else
                                                <option value="">Remarque : Il y a aucune Commande.</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('commande_id'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('commande_id') }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="Div_email Div_btn_s" title="Actions">
                                        <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                                        <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Ajouter</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('_Fact_.index') }} "> Voir les Factures </a></button>
                    </div>
                </div>
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
            </div>
        @endif
    </div>

 
@endsection