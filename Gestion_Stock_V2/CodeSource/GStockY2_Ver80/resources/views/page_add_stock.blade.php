<!-- 
@ extends('Layouts.master')
@ section('ContentComp')
    <div class="content_section">
        @ if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Ajouter un Stock</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" action="{ { route('_stock_.store') }}" method="POST">
                                <input name="ID_Utilisateur_R_administrateur" type="number" value="{ { session('utilisateur.id_Utilisateur') }}" hidden>
                                @ if(session('message_success'))
                                    <div class="alert_message alert_message_role alert_succes">
                                        { { session('message_success') }}
                                    </div>
                                @ endif

                                @ if(session('message_error'))
                                    <div class="alert_message alert_message_role alert_error">
                                        { { session('message_error') }}
                                    </div>
                                @ endif
                                @ csrf
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="ID_Utilisateur_R_Fournisseur">Le Fournisseur :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="ID_Utilisateur_R_Fournisseur">
                                            @ if (isset($fournisseurs) && Count($fournisseurs) >= 1)
                                                <option value=""> Choisir un Fournisseur </option>
                                                @ foreach($fournisseurs as $fournisseur)
                                                    <option value=" { { $fournisseur->id_Utilisateur }} "> { { $fournisseur->nom }} { { $fournisseur->prenom }} </option>
                                                @ endforeach
                                            @ else
                                                <option value="">Remarque : Il y a aucun Fournisseur.</option>
                                            @ endif
                                        </select>
                                        @ if ($errors->has('ID_Utilisateur_R_Fournisseur'))
                                            <div class="alert_message alert_message_role alert_error">
                                                { { $errors->first('ID_Utilisateur_R_Fournisseur') }}
                                            </div>
                                        @ endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="ID_Produit">Le Produit :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="ID_Produit">
                                            @ if (isset($produits_data) && Count($produits_data) >= 1)
                                                <option value=""> Choisir un Produit </option>
                                                @ foreach($produits_data as $produit_data)
                                                    <option value=" { { $produit_data->ID_Produit }} "> { { $produit_data->nom }} </option>
                                                @ endforeach
                                            @ else
                                                <option value="">Remarque : Il y a aucun Produit.</option>
                                            @ endif
                                        </select>
                                        @ if ($errors->has('ID_Produit'))
                                            <div class="alert_message alert_message_role alert_error">
                                                { { $errors->first('ID_Produit') }}
                                            </div>
                                        @ endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="quantite">Quantité :</label><br>
                                        <input  @ if (isset($produits_data)) min=" { { $produits_data->quantite }} " @ endif class="input_lable Input_item input_lable_s_btn" type="number" name="quantite" id="quantite" placeholder="Entrer la Quantité du produit">
                                        @ if ($errors->has('quantite'))
                                            <div class="alert_error alert_message alert_message_role">
                                                { { $errors->first('quantite') }}
                                            </div>
                                        @ endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <label class="input_lable input_lable_s_btn" for="Status">La Status du Ce Stock :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="status">
                                                <option value=""> Choisir un Produit </option>
                                                <option value="Entrant">Entrant</option>
                                                <option value="Sortant">Sortant</option>
                                        </select>
                                        @ if ($errors->has('status'))
                                            <div class="alert_message alert_message_role alert_error">
                                                { { $errors->first('status') }}
                                            </div>
                                        @ endif
                                    </div>
                                    <div class="Div_email Div_btn_s" title="Actions">
                                        <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                                        <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Ajouter</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" { { route('_stock_.index') }} "> Voir les Categories </a></button>
                    </div>
                </div>
        @ else
            <p>Vous este pas autorisée.</p>
        @ endif
    </div>
@ endsection -->

@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Ajouter un Stock</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" action="{{ route('_stock_.store') }}" method="POST">
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
                                        <label class="input_lable input_lable_s_btn" for="ID_Utilisateur_R_Fournisseur">Le Fournisseur :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="ID_Utilisateur_R_Fournisseur">
                                            @if (isset($fournisseurs) && Count($fournisseurs) >= 1)
                                                <option value=""> Choisir un Fournisseur </option>
                                                @foreach($fournisseurs as $fournisseur)
                                                    <option value=" {{ $fournisseur->id_Utilisateur }} "> {{ $fournisseur->nom }} {{ $fournisseur->prenom }} </option>
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
                                                <option value=""> Choisir un Produit </option>
                                                @foreach($produits_data as $produit_data)
                                                    <option value="{{ $produit_data->id_produit }}" data-quantite="{{ $produit_data->quantite }}"> {{ $produit_data->nom }} </option>
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
                                                <option value=""> Choisir un Produit </option>
                                                <option value="Entrant">Entrant</option>
                                                <option value="Sortant">Sortant</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('status') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="Quantite">Quantité :</label><br>
                                        <input class="input_lable Input_item input_lable_s_btn" type="number" name="Quantite" id="quantite" placeholder="Entrer la Quantité du produit" min="1">
                                        @if ($errors->has('Quantite'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('Quantite') }}
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
                        <button class="btn btn_sbt"><a href=" {{ route('_stock_.index') }} "> Voir les Stocks </a></button>
                    </div>
                </div>
        @else
            <p>Vous n'êtes pas autorisé.</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const produitSelect = document.getElementById('ID_Produit');
            const quantiteInput = document.getElementById('quantite');
            const statusSelect = document.getElementById('status');

            produitSelect.addEventListener('change', function() {
                updateQuantite();
            });

            statusSelect.addEventListener('change', function() {
                updateQuantite();
            });

            function updateQuantite() {
                const selectedOption = produitSelect.options[produitSelect.selectedIndex];
                const quantite = selectedOption.getAttribute('data-quantite');
                const status = statusSelect.value;

                if (status === 'Sortant' && quantite) {
                    quantiteInput.max = quantite;
                    quantiteInput.value = quantite;
                } else {
                    quantiteInput.removeAttribute('max');
                    quantiteInput.value = quantite;
                }
            }
        });
    </script>
@endsection
