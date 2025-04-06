FROM php:8.2-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Ativar mod_rewrite
RUN a2enmod rewrite

# Configurar o Apache para apontar para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Substituir o default.conf para apontar pro /public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Copiar os arquivos do projeto Laravel
COPY . /var/www/html

WORKDIR /var/www/html

# Instalar o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependências PHP do Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões necessárias
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

EXPOSE 80
