# Image de base
FROM php:8.2-apache

# Installer les outils nécessaires
RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip \
    unzip \
    nano \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    bash \
    npm \
    && docker-php-ext-install pdo_mysql mysqli \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Active mod_rewrite
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de configuration Tailwind
COPY package.json tailwind.config.js postcss.config.js ./

# Préparer un cache npm sans conflit
ENV npm_config_cache=/tmp/.npm
RUN mkdir -p /tmp/.npm && chown -R root:root /tmp/.npm

# Installer les dépendances (en root pour éviter les erreurs)
RUN npm install

# Donner les droits sur node_modules à www-data
RUN chown -R www-data:www-data /app/node_modules

# Compiler Tailwind une fois
RUN npx tailwindcss -i ./src/assets/css/input.css -o ./src/assets/css/output.css

# Copier l'application PHP
COPY ./src/ /var/www/html/

# Donner les droits d'accès au serveur
RUN chown -R www-data:www-data /var/www/html

# Passer à www-data
USER www-data

EXPOSE 80