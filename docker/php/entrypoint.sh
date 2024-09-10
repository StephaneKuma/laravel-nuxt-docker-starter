#!/bin/bash

# Afficher les erreurs en cas de problème
set -e

# Installer les dépendances PHP via Composer si le dossier "vendor" n'existe pas encore
if [ ! -d "vendor" ]; then
    echo "Installation des dépendances PHP..."
    composer install
fi

php artisan serve --host=0.0.0.0 --port=8000
