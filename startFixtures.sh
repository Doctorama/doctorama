#!/bin/bash

# Supprime la base de données
php app/console doctrine:database:drop --force 
# Créer la base de données
php app/console doctrine:database:create
# Mise à jour des tables
php app/console doctrine:schema:update --force
# Utilisation des Fixtures pour les jeux de données
php app/console doctrine:fixtures:load --fixtures=src/DT/DoctoramaBundle/DataFixtures 

exit 0