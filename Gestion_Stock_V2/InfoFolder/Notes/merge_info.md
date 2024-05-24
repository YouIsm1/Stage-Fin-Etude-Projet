Pour fusionner la branche `test_main` dans la branche `main`, tu peux utiliser la commande `git merge`. Voici les étapes à suivre :

1. **Assure-toi d'être sur la branche `main`** :
   Si tu n'y es pas déjà, passe à la branche `main` en utilisant la commande suivante :

   ```bash
   git checkout main
   ```

2. **Fusionne la branche `test_main` dans la branche `main`** :
   Utilise la commande `git merge` suivie du nom de la branche que tu veux fusionner, dans ce cas `test_main` :

   ```bash
   git merge test_main
   ```

   Cette commande va fusionner tous les commits de la branche `test_main` dans la branche `main`.

3. **Résoudre les conflits (si nécessaire)** :
   S'il y a des conflits entre les modifications apportées dans la branche `main` et celles de la branche `test_main`, Git te demandera de les résoudre. Tu devras ouvrir les fichiers en conflit, résoudre les conflits manuellement, puis les ajouter et valider les changements.

4. **Valider le merge** :
   Une fois que tous les conflits sont résolus, et que tu es satisfait des modifications résultantes, tu peux valider le merge en créant un nouveau commit.

5. **Pousse les changements** :
   Enfin, pousse les changements vers le dépôt distant en utilisant la commande :

   ```bash
   git push origin main
   ```

### Exemple Complet

```bash
# Assure-toi d'être sur la branche main
git checkout main

# Fusionne la branche test_main dans la branche main
git merge test_main

# Résous les conflits (si nécessaire)
# Git te guidera pour résoudre les conflits

# Valide le merge en créant un nouveau commit
# (Git ouvrira un éditeur pour le message de commit)
git commit -m "Merge branch 'test_main' into main"

# Pousse les changements vers le dépôt distant
git push origin main
```

Cela va fusionner les modifications de la branche `test_main` dans la branche `main`, résoudre les conflits s'il y en a, créer un nouveau commit pour le merge, et pousser les changements vers le dépôt distant.



