<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>page d'authentification</title>
    </head>
    <body>

        <div class="Div_body">
            <div class="Div_container">
                <h1>Bienvenue sur la page d'authentification</h1>
                <div class="Div_connecter">
                    <form action="">
                        @csrf
                            <div class="Div_email">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="Div_password">
                                <label for="mot_de_passe">Mot de passe</label>
                                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe">
                            </div>
                            <div class="Div_btn_s">
                                <button type="submit" class="btn_form">connecter</button>
                                <button type="reset"  class="btn_form">annuler</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>