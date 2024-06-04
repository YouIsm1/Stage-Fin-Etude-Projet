@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2))
            <div class="page_role_div">
                <div class="titre">
                    <h2>Ajouter un Règlement</h2>
                </div>
                <div class="dparb">
                    <div class="form_div">
                        <form class="form_item" action="{{ route('_Regl_.store') }}" method="POST">
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
                                <label class="input_lable input_lable_s_btn" for="ID_Utilisateur_R_Client">Le Client :</label><br>
                                <select class="input_lable Input_item input_lable_s_btn" name="ID_Utilisateur_R_Client">
                                    @if (isset($clients) && Count($clients) >= 1)
                                        <option value=""> Choisir un client </option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id_Utilisateur }}">{{ $client->nom }} {{ $client->prenom }}</option>
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
                                        @foreach($Factures_data as $Facture_data)
                                            <option value="{{ $Facture_data->id_facture }}" data-montant-restant="{{ $factures_montant_restant[$Facture_data->id_facture] }}">
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
                                <input min="1" class="input_lable Input_item input_lable_s_btn" type="number" name="montant_de_reglement" id="montant_de_reglement" placeholder="Entrer le montant totale du règlement" value="{{ old('montant_de_reglement') }}">
                                @if ($errors->has('montant_de_reglement'))
                                    <div class="alert_error alert_message alert_message_role">
                                        {{ $errors->first('montant_de_reglement') }}
                                    </div>
                                @endif
                            </div>
                            <div class="Div_email Div_btn_s" title="Actions">
                                <button class="input_lable btn btn_rst btn_ann" type="reset" class="btn_form">annuler</button>
                                <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                    <button class="btn btn_sbt"><a href="{{ route('_Regl_.index') }}"> Voir les Règlements </a></button>
                </div>
            </div>
        @else
            <p>Vous n'êtes pas autorisé.</p>
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
