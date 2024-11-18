# Progression

```bash
# vérifie la configuration de votre machine pour SF
 symfony check:requirements 

 # api platform
 composer require api

# démarrer le serveur dans l'app
symfony serve --no-tls

 ```

 - installer la bd

`.env` de SF

```txt
DATABASE_URL="postgresql://admin:password@127.0.0.1:5432/tree-learning-api?serverVersion=16&charset=utf8"
```

- création de la bd

```bash
php bin/console doctrine:database:create

# sérializer les objets
composer require symfony/serializer

# créer des fakers (données factices)
composer require --dev zenstruck/foundry

# maker
composer require --dev symfony/maker-bundle
```

On utilise git pour travailler, pour l'instant on travaille sur dev 

```bash
git checkout -b dev 
```

## Création des entités

```bash
php bin/console make:entity

# création du SQL pour créer les tables
php bin/console make:migration

# on passe à la création des tables dans la base de données
php bin/console doctrine:migrations:migrate
```

