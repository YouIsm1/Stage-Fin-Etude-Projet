



@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2))
            @if(isset($Reglement_data))
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Modifier un Règlement</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" method="Post" action="{{ route('_Regl_.update', $Reglement_data->id_reglement) }}">
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
                                @method('PUT')
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="ID_Utilisateur_R_Client">Le Client :</label><br>
                                        <!-- <p>{ { $Reglement_data->ID_Utilisateur_R_Client }}</p> -->
                                        <select class="input_lable Input_item input_lable_s_btn" name="ID_Utilisateur_R_Client">
                                            @if (isset($clients) && Count($clients) >= 1)
                                                <!-- <option value=""> Choisir un client </option> -->
                                                @foreach($clients as $client)
                                                    <!-- <option value=" { { $client->id_Utilisateur }} "> { { $client->nom }} { { $client->prenom }} </option> -->
                                                    <option @if($client->id_Utilisateur == $Reglement_data->ID_Utilisateur_R_Client) selected @endif
                                                        value=" {{ $client->id_Utilisateur }} "> 
                                                        {{ $client->nom }} {{ $client->prenom }} 
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">Remarque : Il y a aucun Client.</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('ID_Utilisateur_R_Client'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('ID_Utilisateur_R_Client') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="Facture_ID">La Facture :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="Facture_ID" id="Facture_ID">
                                            @if (isset($Factures_data) && Count($Factures_data) >= 1)
                                                <option value=""> Choisir une facture </option>
                                                <!-- @ foreach($Factures_data as $Facture_data)
                                                    <option @ if($Factures_data->id_facture == $Reglement_data->Facture_ID) selected @ endif
                                                        value="{ { $Facture_data->id_facture }}" data-montant-restant="{ { $factures_montant_restant[$Facture_data->id_facture] }}">
                                                        { { $Facture_data->id_facture }}
                                                    </option>
                                                @ endforeach -->
                                                @foreach($Factures_data as $Facture_data)
                                                    <option @if($Facture_data->id_facture == $Reglement_data->Facture_ID) selected @endif
                                                        value="{{ $Facture_data->id_facture }}" data-montant-restant="{{ $factures_montant_restant[$Facture_data->id_facture] }}">
                                                        {{ $Facture_data->id_facture }}
                                                    </option>
                                                @endforeach

                                            @else
                                                <option value="">Remarque : Il y a aucune facture.</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('Facture_ID'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('Facture_ID') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="montant_de_reglement">Le Montant :</label><br>
                                        <input min="1" class="input_lable Input_item input_lable_s_btn" type="number" name="montant_de_reglement" id="montant_de_reglement" placeholder="Entrer le montant totale du règlement" value="{{ $Reglement_data -> montant_de_reglement }}">
                                        @if ($errors->has('montant_de_reglement'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('montant_de_reglement') }}
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
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('_Comm_.index') }} "> Voir les Règlements </a></button>
                    </div>
                </div>
            @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                    <p>Il y a aucune donee pour Reglement.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('_Comm_.index') }} "> Voir les Reglements </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous êtes pas autorisée pour entrer cette page.</p>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const factureSelect = document.getElementById('Facture_ID');
            const montantInput = document.getElementById('montant_totale');

            if (factureSelect && montantInput) {
                factureSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const montantRestant = selectedOption.getAttribute('data-montant-restant');
                    if (montantRestant) {
                        montantInput.setAttribute('max', montantRestant);
                    } else {
                        montantInput.removeAttribute('max');
                    }
                });
            }
        });
    </script>
@endsection
