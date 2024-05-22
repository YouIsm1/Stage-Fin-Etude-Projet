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
                    <form action="">
                        @csrf
                            <div class="Div_email">
                                <label class="input_lable" for="email">Email :</label><br>
                                <input class="input_lable Input_item" type="email" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="Div_email Div_password">
                                <label class="input_lable" for="mot_de_passe">Mot de passe :</label><br>
                                <input class="input_lable Input_item" type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe">
                            </div>
                            <div class="Div_email Div_btn_s">
                                <button class="input_lable btn btn_sbt" type="submit" class="btn_form">connecter</button>
                                <button class="input_lable btn btn_rst" type="reset"  class="btn_form">annuler</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>