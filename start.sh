#!/bin/bash

# Lancer Tailwind CSS en watch si le fichier source existe
if [ -f ./assets/input.css ]; then
  echo "🔁 Compilation Tailwind lancée"
  npx tailwindcss -i ./assets/input.css -o ./public/style.css --watch &
else
  echo "⚠️ Fichier input.css introuvable, Tailwind non lancé"
fi

# Lancer Apache en premier plan pour bloquer le conteneur
echo "🚀 Démarrage d'Apache"
exec apache2-foreground