



@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
            @if(isset($Commande_data))
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Modifier un Commande</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" method="Post" action="{{ route('_Comm_.update', $Commande_data->id_Commande) }}">
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
                                        <select class="input_lable Input_item input_lable_s_btn" name="ID_Utilisateur_R_Client">
                                            @if (isset($clients) && Count($clients) >= 1)
                                                <!-- <option value=""> Choisir un client </option> -->
                                                @foreach($clients as $client)
                                                    <!-- <option value=" { { $client->id_Utilisateur }} "> { { $client->nom }} { { $client->prenom }} </option> -->
                                                    <option @if($client->id_Utilisateur == $Commande_data->ID_Utilisateur_R_client) selected @endif
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

                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="description">Description du Commande :</label><br>
                                        <!-- <textarea class="input_lable Input_item input_lable_s_btn" type="description" name="description" id="description" placeholder="Entrer la description du Commande" value="{ { old('description') }}"></textarea> -->
                                        <textarea class="input_lable Input_item input_lable_s_btn" type="description" name="description" id="description" placeholder="Entrer la description du Commande" value="{{ old('description') }}"> {{ $Commande_data->description }} </textarea>
                                        @if ($errors->has('description'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('description') }}
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
                        <button class="btn btn_sbt"><a href=" {{ route('_Comm_.index') }} "> Voir les Commandes </a></button>
                    </div>
                </div>
            @else
                <div class="page_role_div dparb dpafrb btn_add_role_link">
                    <p>Il y a aucune donee pour Commande.</p>
                    <button class="btn btn_sbt"><a href=" {{ route('_Comm_.index') }} "> Voir les Commandes </a></button>
                </div>
            @endif
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous êtes pas autorisée pour entrer cette page.</p>
            </div>
        @endif
    </div>
@endsection
