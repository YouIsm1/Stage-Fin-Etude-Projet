
@extends('Layouts.master')
@section('ContentComp')
    <div class="content_section">
        @if(session()->has('utilisateur') && session('utilisateur.role.id_Role') == 1)
                <div class="page_role_div">
                    <div class="titre">
                        <h2>Ajouter un Produit</h2>
                    </div>
                    <div class="dparb">
                        <div class="form_div">
                            <form class="form_item" action="{{ route('_prod_.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="img_file Div_role_name Div_email" id="id_img_file">
                                        <!-- <label  title="Ajouter une image"  id="btn_add_img" class="input inp_t btn_sbt wit input_lable Input_item input_lable_s_btn"> Ajouter les images du Produit </label><br><br> -->
                                        <div  title="Ajouter une image"  id="btn_add_img" class="input_lable input_lable_s_btn"> Ajouter les images du Produit :</div>
                                        <!-- <br><br> -->
                                        <div>
                                            <input type="file" value="{{ old('nom_1') }}"  name="nom_1" class="input inp_t btn_sbt wit input_lable Input_item input_lable_s_btn border_inpt">
                                            @if ($errors->has('nom_1'))
                                                <div class="alert_error alert_message alert_message_role">
                                                    {{ $errors->first('nom_1') }}
                                                </div>
                                            @endif

                                            <input type="file" value="{{ old('nom_2') }}"  name="nom_2" class="input inp_t btn_sbt wit input_lable Input_item input_lable_s_btn border_inpt">
                                            @if ($errors->has('nom_2'))
                                                <div class="alert_error alert_message alert_message_role">
                                                    {{ $errors->first('nom_2') }}
                                                </div>
                                            @endif

                                            <input type="file" value="{{ old('nom_3') }}"  name="nom_3" class="input inp_t btn_sbt wit input_lable Input_item input_lable_s_btn border_inpt">
                                            @if ($errors->has('nom_3'))
                                                <div class="alert_error alert_message alert_message_role">
                                                    {{ $errors->first('nom_3') }}
                                                </div>
                                            @endif

                                            <input type="file" value="{{ old('nom_4') }}"  name="nom_4" class="input inp_t btn_sbt wit input_lable Input_item input_lable_s_btn border_inpt">
                                            @if ($errors->has('nom_4'))
                                                <div class="alert_error alert_message alert_message_role">
                                                    {{ $errors->first('nom_4') }}
                                                </div>
                                            @endif
                                        </div>
                                        <!-- <script>
                                            let id_img_file_js = document.getElementById("id_img_file");
                                            let btn_add_img_js = document.getElementById("btn_add_img");
                                            let i=0;

                                            btn_add_img_js.onclick=function(){
                                                console.log("click");
                                                console.log(i);
                                                if(i<4) {
                                                    console.log("click interne");
                                                    console.log(i);

                                                    let ino_file_js = document.createElement("input");
                                                    let br_js = document.createElement("br");

                                                    ino_file_js.setAttribute('type','file');

                                                    ino_file_js.setAttribute('id','file_img_'+i);
                                                    // btn_add_img_js.setAttribute('for','file_img');
                                                    btn_add_img_js.setAttribute('for','file_img'+i);

                                                    ino_file_js.setAttribute('class','input_lable Input_item input_lable_s_btn');
                                                    ino_file_js.setAttribute('name','nom_'+(i+1));
                                                    ino_file_js.setAttribute('multiple', true);

                                                    id_img_file_js.appendChild(ino_file_js);
                                                    id_img_file_js.appendChild(br_js);
                                                    // ino_file_js.style.display="Block";

                                                    i++;
                                                }else {
                                                    // window.alret("this enough");
                                                    alert("this enough");
                                                    i++;
                                                }

                                            }
                                        </script> -->
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="nom">Nom du Produit :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="text" name="nom" id="nom" placeholder="Entrer le nom du Produit" value="{{ old('nom') }}">
                                        @if ($errors->has('nom'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('nom') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="description">Description du Produit :</label><br>
                                        <!-- <input class="input_lable Input_item input_lable_s_btn" type="description" name="description" id="description" placeholder="Entrer la description du Produit" value="{ { old('description') }}"> -->
                                        <textarea class="input_lable Input_item input_lable_s_btn" type="description" name="description" id="description" placeholder="Entrer la description du Produit" value="{{ old('description') }}"></textarea>
                                        @if ($errors->has('description'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="quantite">Quantité :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="number" name="quantite" id="quantite" placeholder="Entrer la Quantité du produit" value="{ { old('quantite') }}">
                                        @ if ($errors->has('quantite'))
                                            <div class="alert_error alert_message alert_message_role">
                                                { { $errors->first('quantite') }}
                                            </div>
                                        @ endif
                                    </div> -->
                                    <div class="Div_role_name Div_email">
                                        <label class="input_lable input_lable_s_btn" for="prix">Prix :</label><br>
                                        <input min="4" class="input_lable Input_item input_lable_s_btn" type="number" name="prix" id="prix" placeholder="Entrer le prix du produit" value="{{ old('prix') }}">
                                        @if ($errors->has('prix'))
                                            <div class="alert_error alert_message alert_message_role">
                                                {{ $errors->first('prix') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="Div_description_role Div_email Div_password">
                                        <!-- { { $categ_s_data }} -->
                                        <label class="input_lable input_lable_s_btn" for="id_">La Catégorie :</label><br>
                                        <select class="input_lable Input_item input_lable_s_btn" name="id_categorie" id="">
                                            @if (isset($categ_s_data) && count($categ_s_data) >= 1)
                                                <option value="">Choisir une Catégorie</option>
                                                @foreach($categ_s_data as $categ_data)
                                                    <option value=" {{ $categ_data->id_categorie }} "> {{ $categ_data->nom }} </option>
                                                @endforeach
                                            @else
                                                <option value="">--Il y a aucune Catégorie--</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('id_categorie'))
                                            <div class="alert_message alert_message_role alert_error">
                                                {{ $errors->first('id_categorie') }}
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
                        <button class="btn btn_sbt"><a href=" {{ route('_prod_.index') }} "> Voir les Utilisateurs </a></button>
                    </div>
                </div>
        @else
            <div class="page_role_div dparb dpafrb btn_add_role_link">
                <p>Vous este pas autorisée.</p>
            </div>
        @endif
    </div>
@endsection
