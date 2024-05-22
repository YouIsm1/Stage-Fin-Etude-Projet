<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>page d'authentification</title>
        @vite('resources/css/app.css')
    </head>
    <body class="Body_page_anthentication">

        <div class="Div_body">
            <div class="Div_container">
                <h1 class="titre" >Bienvenue sur la page d'authentification</h1>
                <div class="Div_connecter">
                    <form action="{{ route('authentification') }}" method="POST">
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
                            <div class="Div_email">
                                <label class="input_lable input_lable_s_btn" for="email">Email :</label><br>
                                <input class="input_lable Input_item input_lable_s_btn" type="email" name="email" id="email" placeholder="Entrer l'email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="alert_message alert_error">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                @if(session('err_email_n_e'))
                                    <div class="alert_message alert_error">
                                        {{ session('err_email_n_e') }}
                                    </div>
                                @endif
                            </div>
                            <div class="Div_email Div_password">
                                <label class="input_lable input_lable_s_btn" for="mot_de_passe">Mot de passe :</label><br>
                                <input class="input_lable Input_item input_lable_s_btn" type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Entrer le mot de passe" value="{{ old('mot_de_passe') }}">
                                @if ($errors->has('mot_de_passe'))
                                    <div class="alert_message alert_error">
                                        {{ $errors->first('mot_de_passe') }}
                                    </div>
                                @endif
                                @if(session('err_mto'))
                                    <div class="alert_message alert_error">
                                        {{ session('err_mto') }}
                                    </div>
                                @endif
                            </div>
                            <div class="Div_email Div_btn_s" title="Actions">
                                <button class="input_lable btn btn_sbt" type="submit" class="btn_form">connecter</button>
                                <button class="input_lable btn btn_rst btn_ann" type="reset"  class="btn_form">annuler</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
