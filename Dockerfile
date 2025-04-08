# Image de base
FROM php:8.2-apache

# Installer les outils nécessaires
RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip\
    unzip \
    nano \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    bash \
    nodejs \
    npm\
    && docker-php-ext-install pdo_mysql mysqli

# Activer mod_rewrite
RUN a2enmod rewrite

# Éviter le warning Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier les fichiers
COPY ./src/ /var/www/html/

# Installer les dépendances npm
RUN if [ -f package.json ]; then npm install; fi

# Exposer le port
EXPOSE 80

# Donner les droits d'exécution à notre script de démarrage
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Lancer Apache et npm run dev en parallèle
CMD ["/start.sh"]
