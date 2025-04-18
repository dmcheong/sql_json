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

# Dossier de travail pour npm sinon ecrasement par le volume de docker-compose
WORKDIR /app

# Copie des fichiers Tailwind
COPY package*.json ./ 
COPY tailwind.config.js postcss.config.js ./

# Nettoyage & setup du cache npm
RUN rm -rf /tmp/.npm && mkdir -p /tmp/.npm && chmod -R 777 /tmp/.npm

# Définir le cache pour npm/npx
ENV npm_config_cache=/tmp/.npm

# activer le mode développement
ENV NODE_ENV=development

# Installer les dépendances
RUN npm install

# a cause de l'écrasement dans le docker-compose du volume /var/www/html/, on effectue la copie dans la command du docker-compose
# on laisse ici la trace de construction pour la comprehension
# # Copier Alpine.js dans un dossier public accessible par Apache
# RUN mkdir -p /var/www/html/assets/vendor/alpine && \
#     cp /app/node_modules/alpinejs/dist/cdn.min.js /var/www/html/assets/vendor/alpine/alpine.min.js
    
# Vérification : afficher ce qu’on a installé
RUN echo "node_modules :" && ls -la node_modules && npm list --depth=0

# Copier les fichiers nécessaires à Tailwind
COPY ./src ./src

# Compiler Tailwind
RUN npx tailwindcss -i ./src/assets/css/input.css -o ./src/assets/css/output.css

# Dossier de travail pour apache
# WORKDIR /var/www/html