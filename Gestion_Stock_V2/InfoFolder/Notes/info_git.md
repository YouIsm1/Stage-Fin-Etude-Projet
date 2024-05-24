

    on a une commit deja pushee.

    on a le code dans un branch spécifique.

    alors nous faisons des modifications sur code locale et executer git add ---- mais non commitée.

    on peut retourner a la commit deja pushee on utilise :

    git reset --hard --commit-id--

    mais si les modefications deja commitee on peut utilisee aussi :

    git reset --hard --commit-id--

-> notee que tout ca et git locale.

!> mais pour les modefications pushee on utilise aussi :

    git reset --hard --commit-id--

    mais pour pusher tu doit executer cette commande:

    git push origin main --force instead of: git push origin

!!> mais aussi causer des problemes pour les collaborateurs: Conséquences de git push --force

Réécriture de l'historique: Tous les commits qui ont été supprimés localement seront également supprimés du dépôt distant. Cela peut causer des problèmes pour les autres développeurs qui ont basé leur travail sur ces commits.

Synchronisation des collaborateurs: Les autres développeurs devront forcer la synchronisation de leurs dépôts locaux avec le dépôt distant mis à jour. Ils devront exécuter:

git fetch origin
git reset --hard origin/main

