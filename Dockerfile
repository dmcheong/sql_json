# Image complète avec Apache et PHP
FROM php:8.2-apache

# Installer des outils utiles pour dev
RUN apt-get update && apt-get install -y \
    bash \
    curl \
    git \
    zip \
    unzip \
    nano \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mysqli

# Activation du module Apache mod_rewrite (utile pour les routes propres)
RUN a2enmod rewrite

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier uniquement à l'exécution du conteneur via volume
COPY ./src/ /var/www/html/

# Exposition du port HTTP
EXPOSE 80

# Commande par défaut
CMD ["apache2-foreground"]
