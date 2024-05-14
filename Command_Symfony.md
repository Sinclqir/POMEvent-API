# Commande Symfony

## Installation symfony ou mise à jour
``scoop install symfony-cli`` </br>
``scoop update symfony-cli`` </br>

## Lancer ou installer un projet 
### Crée un nouveau projet
``symfony new nom_projet`` </br>

``symfony composer require api-platform/api-pack`` </br>
``symfony composer require api`` </br>
``composer require jwt-auth`` </br>
``composer require --dev symfony/maker-bundle`` essentiel pour utiliser la commande "MAKE" </br>

### Intaller le projet sur la machine
Intall toute les dépendances définit dans le projet :
``composer install`` </br>


## BDD (avec install de doctrine)
Base de donnée : ``composer require orm``</br>
**DANS** ``.env``, **ENLEVER COMMENTAIRE DE LA LIGNE :** </br>
``"DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"`` </br>
**COMMENTER LES AUTRES LIGNES COMMENCANT PAR** ``"DATABASE_URL="`` </br>
``symfony console doctrine:database:create`` </br>
``symfony console make:entity`` </br>

### Migration après avoir ajouter une entity
``symfony console make:migration`` </br>
``php bin/console doctrine:migrations:migrate`` </br>
``php bin/console doctrine:migration:list`` </br>
</br>
**Voir fichier** : ``migrate.sh`` pour automatisation

## Optionnel
Création d'un formulaire : ``symfony console make:registration-form``

### Vide le cache (après migration)
``bin/console cache:clear``

### Lancement du serveur
``symfony server:start`` OU ``symfony serve``

### Autre
``php bin/console make: XXX`` </br>

    - make:user : génère un utilisateur
    - make:command : génère une nouvelle commande
    - make:controller : génère un nouveau contrôleur
    - make:form : génère une nouvelle classe de formulaire
    - make:test : génère un nouveau test
    - make:entity : génère une nouvelle entité Doctrine
    - make:migration : génère une nouvelle migration Doctrine

Installe le package symfony/flex :``composer require symfony/flex`` </br>

Permet de s'assurer que votre projet dispose de tous les outils nécessaires pour démarrer rapidement et facilement. </br>

Extrait les variables d'environnement du fichier .env.dev dans des constantes PHP :``composer dump-env dev`` </br>
Sous entend un fichier ``.env.dev``
