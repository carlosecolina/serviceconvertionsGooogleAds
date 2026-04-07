FROM php:8.2-fpm

# Instalar dependencias del sistema, incluyendo WEBP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libwebp-dev \
    zip \
    unzip \
    nano \
    curl \
    tzdata \
    cron \
    && rm -rf /var/lib/apt/lists/*

# Zona horaria
RUN ln -sf /usr/share/zoneinfo/America/Lima /etc/localtime

# Configurar GD con soporte para WEBP
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp


# Instalar Node.js 20.9.0
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs=20.9.0-1nodesource1

# Instalar extensiones PHP
RUN docker-php-ext-install pdo pdo_mysql zip gd bcmath

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Permisos Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Generar app key
RUN php artisan key:generate --force

# Crear enlace simbólico de storage
# RUN php artisan storage:link

COPY ./crontab /etc/cron.d/laravel-cron
RUN chmod 0644 /etc/cron.d/laravel-cron
RUN crontab /etc/cron.d/laravel-cron
RUN touch /var/log/cron.log

# Exponer puerto
EXPOSE 9000

CMD ["sh", "-c", "cron && php-fpm"]
