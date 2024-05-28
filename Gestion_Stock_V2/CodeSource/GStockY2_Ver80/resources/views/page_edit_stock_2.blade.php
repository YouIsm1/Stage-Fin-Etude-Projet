



@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            @if(isset($Stock_data))
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Modifier un Stock</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                        <form class="form_item" method="Post" action="{{ route('_user_.update', $Stock_data->id_Utilisateur) }}">
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
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="ID_Utilisateur_R_Fournisseur">Le Fournisseur :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="ID_Utilisateur_R_Fournisseur">
                                            @if (isset($fournisseurs) && Count($fournisseurs) >= 1)
                                                @foreach($fournisseurs as $fournisseur)
                                                    <option @if($fournisseur->id_Utilisateur == $Stock_data->ID_Utilisateur_R_Fournisseur) selected @endif
                                                        value=" {{ $fournisseur->id_Utilisateur }} "> 
                                                        {{ $fournisseur->nom }} {{ $fournisseur->prenom }} 
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">Remarque : Il y a aucun Fournisseur.</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('ID_Utilisateur_R_Fournisseur'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('ID_Utilisateur_R_Fournisseur') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="ID_Produit">Le Produit :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="ID_Produit" id="ID_Produit">
                                            @if (isset($produits_data) && Count($produits_data) >= 1)
                                                <!-- <option value=""> Choisir un Produit </option> -->
                                                @foreach($produits_data as $produit_data)
                                                    <option @if($produit_data->id_produit == $Stock_data->ID_Produit) selected @endif 
                                                        value="{{ $produit_data->id_produit }}" data-quantite="{{ $produit_data->quantite }}">
                                                        {{ $produit_data->nom }} 
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">Remarque : Il y a aucun Produit.</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('ID_Produit'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('ID_Produit') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="Status">La Status du Ce Stock :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="status" id="status">
                                                <!-- <option value=""> Choisir un Produit </option> -->
                                                <option  @if("Entrant" == $Stock_data->status) selected @endif value="Entrant">Entrant</option>
                                                <option  @if("Sortant" == $Stock_data->status) selected @endif value="Sortant">Sortant</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('status') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="Quantite">Quantité :</label><br>
                                        <!-- <input class="input_lable Input_item input_lable_s_btn" type="number" name="Quantite" id="quantite" placeholder="Entrer la Quantité du produit" min="1" value="{ { $Stock_data -> Quantite }}" > -->
                                        <input class="input_lable Input_item input_lable_s_btn" type="number" name="Quantite" id="quantite" placeholder="Entrer la Quantité du produit" min="1" value_data="{{ $Stock_data->Quantite }}" value="{{ $Stock_data->Quantite }}">
                                        @if ($errors->has('Quantite'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('Quantite') }}
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
                        <button class="btn btn_sbt"><a href=" {{ route('_stock_.index') }} "> Voir les Stocks </a></button>
                    </div>
                </div>
            @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                    <p>Il y a aucune donee pour Stock.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('_stock_.index') }} "> Voir les Stocks </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous êtes pas autorisée pour entrer cette page.</p>
            </div>
        @endif
    </div>



    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const produitSelect = document.getElementById('ID_Produit');
            const quantiteInput = document.getElementById('quantite');
            const statusSelect = document.getElementById('status');

            produitSelect.addEventListener('change', updateQuantite);
            statusSelect.addEventListener('change', updateQuantite);

            function updateQuantite() {
                const selectedOption = produitSelect.options[produitSelect.selectedIndex];
                const quantite = selectedOption.getAttribute('data-quantite');
                const quantite_data_value = quantiteInput.getAttribute('value_data'); // Obtenir la quantité de stock initiale
                const status = statusSelect.value;

                if (status === 'Sortant' && quantite) {
                    quantiteInput.max = quantite;
                    quantiteInput.value = quantite_data_value; // Utiliser la quantité de stock initiale
                } else {
                    quantiteInput.removeAttribute('max');
                    quantiteInput.value = quantite_data_value; // Utiliser la quantité de stock initiale
                }
            }

            // Appel initial pour définir la quantité en fonction de l'état initial
            updateQuantite();
        });
    </script> -->


@endsection
