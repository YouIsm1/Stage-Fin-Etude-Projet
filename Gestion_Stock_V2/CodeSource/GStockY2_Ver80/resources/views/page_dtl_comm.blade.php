@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && (session('utilisateur.role.id_Role') == 1 || session('utilisateur.role.id_Role') == 2))
        <!-- { { $Commande }} -->
            @if (isset($Commande))
                <div class="index_role page_role_div">
                    <div class="titre">
                        <h3>Associer les produits correspondant a cette Commande</h3>
                    </div>
                    <div class="dparb dpafrb">
                        <div class="table_div">
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

                            @if ($errors->has('produit_id.*'))
                                <div class="alert_message alert_message_role alert_error">
                                    {{ $errors->first('produit_id.*') }}
                                </div>
                            @endif

                            @if ($errors->has('Quantite.*'))
                                <div class="alert_error alert_message alert_message_role">
                                    {{ $errors->first('Quantite.*') }}
                                </div>
                            @endif
                            <table class="table_item" border="1px solid white">
                                <thead>
                                    <tr>
                                        <td> ID de Commande </td>
                                        <td> Gestionnaire </td>
                                        <td> Le Client </td>
                                        <td> description de Commande </td>
                                        <td> la date d'ajout </td>
                                        <td> la date de mise a jour </td>
                                        <td colspan="2">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @ foreach($Commande as $Commande) -->
                                            <tr border="none">
                                                <td> {{ $Commande -> id_Commande }} </td>
                                                <td> {{ $Commande -> Utilisateur_R_Vendeur_Admin -> nom }} {{ $Commande -> Utilisateur_R_Vendeur_Admin -> prenom }} </td>
                                                <td> {{ $Commande -> Utilisateur_R_Client -> nom }} {{ $Commande -> Utilisateur_R_Client -> prenom }} </td>
                                                <td> {{ $Commande -> description }} </td>
                                                <td> {{ $Commande -> created_at }} </td>
                                                <td> {{ $Commande -> updated_at }} </td>
                                                <td >
                                                    <form action="{{ route('_Comm_.destroy', $Commande -> id_Commande) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button class="btn btn_rst" type="submit">Supprimer</button>
                                                    </form>
                                                </td>
                                                <td >
                                                    <form action="{{ route('_Comm_.edit', $Commande -> id_Commande) }}" method="GET">
                                                        @csrf
                                                            <button class="btn btn_sbt" type="submit">Modifier</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <!-- @ endforeach -->
                                </tbody>
                            </table>
                        </div>
                        <div style="width: 70%;" class="table_div">
                            @if (isset($Produit_Commande_Ass_s) && Count($Produit_Commande_Ass_s) >= 1)
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
                                @if ($errors->has('produit_id.*'))
                                    <div class="alert_message alert_message_role alert_error">
                                        {{ $errors->first('produit_id.*') }}
                                    </div>
                                @endif
                                @if ($errors->has('Quantite.*'))
                                    <div class="alert_error alert_message alert_message_role">
                                        {{ $errors->first('Quantite.*') }}
                                    </div>
                                @endif
                                <div class="titre">
                                    <h4>Voila les produits associées a cette Commande</h4>
                                </div>
                                <table class="table_item" border="1px solid white">
                                    <thead>
                                        <tr>
                                            <!-- <td> ID de Commande </td> -->
                                            <td> Produit </td>
                                            <td> Prix d'unite </td>
                                            <td> Quantité </td>
                                            <td> Montant Totale en DH </td>
                                            <td> la date d'ajout </td>
                                            <td> la date de mise a jour </td>
                                            <!-- <td colspan="2">Actions</td> -->
                                            <td colspan="1">Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Produit_Commande_Ass_s as $Produit_Commande_Ass)
                                                <tr border="none">
                                                    <td> {{ $Produit_Commande_Ass -> produit -> nom }} </td>
                                                    <td> @foreach($produits_data_vers as $produit_data) @if($produit_data->id_produit == $Produit_Commande_Ass->produit_id) {{ $produit_data -> prix }} @endif  @endforeach </td>
                                                    <td> {{ $Produit_Commande_Ass -> Quantite }} </td>
                                                    <td> {{ $Produit_Commande_Ass -> montant_total }} </td>
                                                    <td> {{ $Produit_Commande_Ass -> created_at }} </td>
                                                    <td> {{ $Produit_Commande_Ass -> updated_at }} </td>
                                                    <td >
                                                        <form action="{{ route('_Prod_Comm_.destroy', $Produit_Commande_Ass -> id_produit_commande) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                                <button class="btn btn_rst" type="submit">Supprimer</button>
                                                        </form>
                                                    </td>
                                                    <!-- <td >
                                                        <form action="{ { route('_Prod_Comm_.edit', $Produit_Commande_Ass -> id_produit_commande) }}" method="GET">
                                                            @ csrf
                                                                <button class="btn btn_sbt" type="submit">Modifier</button>
                                                        </form>
                                                    </td> -->
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="titre">
                                    <h4>Il y a aucun produit associée a cette Commande</h4>
                                </div>
                            @endif
                        </div>
                        <div class="dparb">
                            <div class="page_role_div dparb dpafrb btn_add_role_link">
                                <button class="btn btn_sbt" id="btn_add_prod">Associer un Produit</button>
                            </div>
                            <div style="display: none;" class="form_div" id="form_div_id">
                                <form class="form_item" action="{{ route('Comm_Ass_prod', $Commande -> id_Commande) }}" method="POST">
                                    <!-- <input name="ID_Utilisateur_R_administrateur" type="number" value="{ { session('utilisateur.id_Utilisateur') }}" hidden> -->
                                    <div class="Div_description_role Div_email Div_password" >
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

                                        @if ($errors->has('produit_id[]'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('produit_id[]') }}
                                            </div>
                                        @endif

                                        @if ($errors->has('Quantite[]'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('Quantite[]') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div id="products_container">

                                    </div>
                                    <div style="cursor: pointer;" class="Div_description_role Div_email Div_password" >
                                        <div class="btn btn_sbt" id="div_add_prod">Associer un Produit</div>
                                    </div>
                                    @csrf
                                    <div class="Div_email Div_btn_s" title="Actions">
                                        <button class="input_lable btn btn_rst btn_ann" type="reset" class="btn_form">annuler</button>
                                        <button class="input_lable btn btn_sbt" type="submit" class="btn_form">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="page_role_div dparb dpafrb btn_add_role_link">
                        <button class="btn btn_sbt"><a href=" {{ route('_Comm_.index') }} "> Voir les Commandes </a></button>
                    </div>
                </div>
            @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                    <p>Il y a aucune Commande.</p>
                    <button class="btn btn_sbt"><a href="{{ route('form_Comm') }}">Ajouter une Commande</a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous êtes pas autorisée pour entrer cette page.</p>
            </div>
        @endif
    </div>

    <script>
        // document.getElementById('btn_add_prod').addEventListener('click', function() {

        //     // let i = 0;
        //     const container = document.getElementById('products_container');
        //     const form_div_id = document.getElementById('form_div_id');

        //     form_div_id.style.display = 'block';

        //     const productDiv = document.createElement('div');
        //     productDiv.classList.add('Div_description_role', 'Div_email', 'Div_password');

        //     productDiv.innerHTML = `
        //         <div style="width: 100%;" class="Div_description_role Div_email Div_password">
        //             <label class="input_lable input_lable_s_btn" for="produit_id[]">Le Produit :</label><br>
        //             <select class="input_lable Input_item input_lable_s_btn" name="produit_id[]">
        //                 @if (isset($produits_data) && Count($produits_data) >= 1)
        //                     <option value="">Choisir un Produit</option>
        //                     @foreach($produits_data as $produit_data)
        //                         <option value="{{ $produit_data->id_produit }}">{{ $produit_data->nom }}</option>
        //                     @endforeach
        //                 @else
        //                     <option value="">Remarque : Il y a aucun Produit.</option>
        //                 @endif
        //             </select>
        //             @if ($errors->has('produit_id[]'))
        //                 <div class="alert_message alert_message_role alert_error">
        //                     {{ $errors->first('produit_id[]') }}
        //                 </div>
        //             @endif
        //         </div>
        //         <div  style="width: 100%;" class="Div_role_name Div_email">
        //             <label class="input_lable input_lable_s_btn" for="Quantite[]">Quantité :</label><br>
        //             <input class="input_lable Input_item input_lable_s_btn" type="number" name="Quantite[]" id="quantite" placeholder="Entrer la Quantité du produit" min="1">
        //             @if ($errors->has('Quantite[]'))
        //                 <div class="alert_error alert_message alert_message_role">
        //                     {{ $errors->first('Quantite[]') }}
        //                 </div>
        //             @endif
        //         </div>
        //     `;

        //     container.appendChild(productDiv);

        //     // i++;
        // });

        // document.addEventListener('DOMContentLoaded', function() {
        //     const produitSelect = document.getElementById('ID_Produit');
        //     const quantiteInput = document.getElementById('quantite');
        //     const statusSelect = document.getElementById('status');

        //     produitSelect.addEventListener('change', function() {
        //         updateQuantite();
        //     });

        //     statusSelect.addEventListener('change', function() {
        //         updateQuantite();
        //     });

        //     function updateQuantite() {
        //         const selectedOption = produitSelect.options[produitSelect.selectedIndex];
        //         const quantite = selectedOption.getAttribute('data-quantite');
        //         const status = statusSelect.value;

        //         if (status === 'Sortant' && quantite) {
        //             quantiteInput.max = quantite;
        //             quantiteInput.value = quantite;
        //         } else {
        //             quantiteInput.removeAttribute('max');
        //             quantiteInput.value = quantite;
        //         }
        //     }
        // });

        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('btn_add_prod').addEventListener('click', function() {
                const container = document.getElementById('products_container');
                const form_div_id = document.getElementById('form_div_id');
                // const div_add_prod = document.getElementById('div_add_prod');
                const btn_add_prod = document.getElementById('btn_add_prod');

                form_div_id.style.display = 'block';

                const productDiv = document.createElement('div');
                productDiv.classList.add('Div_description_role', 'Div_email', 'Div_password');

                productDiv.innerHTML = `
                    <div style="width: 100%;" class="Div_description_role Div_email Div_password">
                        <label class="input_lable input_lable_s_btn" for="produit_id[]">Le Produit :</label><br>
                        <select class="input_lable Input_item input_lable_s_btn produit_select" name="produit_id[]">
                            @if (isset($produits_data) && Count($produits_data) >= 1)
                                <option value="">Choisir un Produit</option>
                                @foreach($produits_data as $produit_data)
                                    <option value="{{ $produit_data->id_produit }}" data-quantite="{{ $produit_data->quantite }}">{{ $produit_data->nom }}</option>
                                @endforeach
                            @else
                                <option value="">Remarque : Il y a aucun Produit.</option>
                            @endif
                        </select>
                        @if ($errors->has('produit_id.*'))
                            <div class="alert_message alert_message_role alert_error">
                                {{ $errors->first('produit_id.*') }}
                            </div>
                        @endif
                    </div>
                    <div style="width: 100%;" class="Div_role_name Div_email">
                        <label class="input_lable input_lable_s_btn" for="Quantite[]">Quantité :</label><br>
                        <input class="input_lable Input_item input_lable_s_btn quantite_input" type="number" name="Quantite[]" placeholder="Entrer la Quantité du produit" min="1">
                        @if ($errors->has('Quantite.*'))
                            <div class="alert_error alert_message alert_message_role">
                                {{ $errors->first('Quantite.*') }}
                            </div>
                        @endif
                    </div>
                `;

                container.appendChild(productDiv);

                // Ajout d'un écouteur d'événement sur le nouveau select pour mettre à jour la quantité max
                const produitSelect = productDiv.querySelector('.produit_select');
                const quantiteInput = productDiv.querySelector('.quantite_input');

                produitSelect.addEventListener('change', function() {
                    updateQuantite(produitSelect, quantiteInput);
                });

                btn_add_prod.style.display = 'none';
            });

            document.getElementById('div_add_prod').addEventListener('click', function() {
                const container = document.getElementById('products_container');
                const form_div_id = document.getElementById('form_div_id');
                const btn_add_prod = document.getElementById('btn_add_prod');

                form_div_id.style.display = 'block';
                btn_add_prod.style.display = 'none';

                const productDiv = document.createElement('div');
                productDiv.classList.add('Div_description_role', 'Div_email', 'Div_password');

                productDiv.innerHTML = `
                    <div style="width: 100%;" class="Div_description_role Div_email Div_password">
                        <label class="input_lable input_lable_s_btn" for="produit_id[]">Le Produit :</label><br>
                        <select class="input_lable Input_item input_lable_s_btn produit_select" name="produit_id[]">
                            @if (isset($produits_data) && Count($produits_data) >= 1)
                                <option value="">Choisir un Produit</option>
                                @foreach($produits_data as $produit_data)
                                    <option value="{{ $produit_data->id_produit }}" data-quantite="{{ $produit_data->quantite }}">{{ $produit_data->nom }}</option>
                                @endforeach
                            @else
                                <option value="">Remarque : Il y a aucun Produit.</option>
                            @endif
                        </select>
                        @if ($errors->has('produit_id.*'))
                            <div class="alert_message alert_message_role alert_error">
                                {{ $errors->first('produit_id.*') }}
                            </div>
                        @endif
                    </div>
                    <div style="width: 100%;" class="Div_role_name Div_email">
                        <label class="input_lable input_lable_s_btn" for="Quantite[]">Quantité :</label><br>
                        <input class="input_lable Input_item input_lable_s_btn quantite_input" type="number" name="Quantite[]" placeholder="Entrer la Quantité du produit" min="1">
                        @if ($errors->has('Quantite.*'))
                            <div class="alert_error alert_message alert_message_role">
                                {{ $errors->first('Quantite.*') }}
                            </div>
                        @endif
                    </div>
                `;

                container.appendChild(productDiv);

                // Ajout d'un écouteur d'événement sur le nouveau select pour mettre à jour la quantité max
                const produitSelect = productDiv.querySelector('.produit_select');
                const quantiteInput = productDiv.querySelector('.quantite_input');

                produitSelect.addEventListener('change', function() {
                    updateQuantite(produitSelect, quantiteInput);
                });
            });

            function updateQuantite(produitSelect, quantiteInput) {
                const selectedOption = produitSelect.options[produitSelect.selectedIndex];
                const quantite = selectedOption.getAttribute('data-quantite');

                if (quantite) {
                    quantiteInput.max = quantite;
                    quantiteInput.value = "";
                } else {
                    quantiteInput.removeAttribute('max');
                    quantiteInput.value = "";
                }
            }
        });

    </script>
@endsection
