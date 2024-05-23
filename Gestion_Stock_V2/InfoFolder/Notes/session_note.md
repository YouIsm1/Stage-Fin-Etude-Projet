Pour remplacer les accès à `$utilisateur` par l'utilisation de la session, vous devez directement accéder aux données de session à l'intérieur de la vue. Voici comment vous pouvez le faire :

1. **Remplacer `isset($utilisateur)` par la vérification de la session :**

   ```php
   @if(session()->has('utilisateur'))
   ```

2. **Remplacer `$utilisateur->role->id_Role` par l'accès à la session :**

   ```php
   @if(session('utilisateur.role.id_Role') == 3)
   ```

### Vue mise à jour avec les modifications :

```html
<div class="sidenav">
    @if(session()->has('utilisateur'))
        @if (session('utilisateur.role.id_Role') == 3)
            <div class="dropdown">
                <button class="dropdown-btn">Voir des Commandes</button>
                <div class="dropdown-content">
                    <a href="#">Afficher les Commandes</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Voir des Factures</button>
                <div class="dropdown-content">
                    <a href="#">Afficher les Factures</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Voir des Règlements</button>
                <div class="dropdown-content">
                    <a href="#">Afficher les Règlements</a>
                </div>
            </div>
        @elseif(session('utilisateur.role.id_Role') == 2)
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Commandes</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un Commande</a>
                    <a href="#">Afficher les Commandes</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Factures</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter une Facture</a>
                    <a href="#">Afficher les Factures</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Règlements</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un Règlement</a>
                    <a href="#">Afficher les Règlements</a>
                </div>
            </div>
        @elseif(session('utilisateur.role.id_Role') == 1)
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Roles</button>
                <div class="dropdown-content">
                    <a href="/form_role">Ajouter un Role</a>
                    <a href="#">Afficher les Roles</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion d'utilisateur</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un utilisateur</a>
                    <a href="#">Afficher les utilisateur</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Categories</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter une Categories</a>
                    <a href="#">Afficher les Categories</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Stocks</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un Stock</a>
                    <a href="#">Afficher les Stocks</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Produits</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un Produits</a>
                    <a href="#">Afficher les produits</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Commandes</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un Commande</a>
                    <a href="#">Afficher les Commandes</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Factures</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter une Facture</a>
                    <a href="#">Afficher les Factures</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion des Règlements</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un Règlement</a>
                    <a href="#">Afficher les Règlements</a>
                </div>
            </div>
        @endif
    @else
        <p class="pr_no_user alert_message alert_error">No user data available.</p>
    @endif
</div>
```

### Explications:

- **Vérification de l'existence de la session :** `@if(session()->has('utilisateur'))` vérifie si la session `utilisateur` existe.
- **Accès aux données de session :** `session('utilisateur.role.id_Role')` permet d'accéder directement aux attributs de l'objet `utilisateur` stocké dans la session.

En suivant ces étapes, vous pouvez remplacer les accès à `$utilisateur` par l'utilisation de la session dans votre vue.