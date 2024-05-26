

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
                    <a href=" {{ route('_role_.index') }} ">Afficher les Roles</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Gestion d'utilisateur</button>
                <div class="dropdown-content">
                    <a href=" {{ route('form_user') }} ">Ajouter un utilisateur</a>
                    <a href=" {{ route('_user_.index') }} ">Afficher les utilisateur</a>
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
                <button class="dropdown-btn">Gestion des Produits</button>
                <div class="dropdown-content">
                    <a href="#">Ajouter un Produits</a>
                    <a href="#">Afficher les produits</a>
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
