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

# Ajouter AllowOverride All dans le VirtualHost
RUN sed -i '/DocumentRoot \/var\/www\/html/a <Directory /var/www/html>\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n</Directory>' /etc/apache2/sites-available/000-default.conf

# Forcer index.php comme page d’accueil
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Dossier de travail
WORKDIR /var/www/html

# Copie des fichiers Tailwind
COPY package.json tailwind.config.js postcss.config.js ./

# Nettoyage & setup du cache npm
RUN rm -rf /tmp/.npm && mkdir -p /tmp/.npm && chmod -R 777 /tmp/.npm

# Définir le cache pour npm/npx
ENV npm_config_cache=/tmp/.npm

# Installer les dépendances
RUN npm install

# Copier les fichiers nécessaires à Tailwind
COPY ./src ./src

# Compiler Tailwind
RUN npx tailwindcss -i ./src/assets/css/input.css -o ./src/assets/css/output.css

