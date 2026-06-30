# Usamos una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalamos dependencias del sistema y Node.js (para compilar Tailwind/Vite)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libpng-dev libonig-dev libxml2-dev \
    curl nodejs npm libpq-dev

# Instalamos las extensiones de PHP necesarias para el ecosistema de Laravel (incluyendo soporte para PostgreSQL)
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Traemos Composer para manejar las dependencias de PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuramos nuestra carpeta de trabajo en el servidor
WORKDIR /var/www/html

# Copiamos todos los archivos de nuestro repositorio a la nube
COPY . .

# Instalamos dependencias del backend y compilamos los assets del frontend
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Damos permisos vitales para que el sistema pueda escribir en caché y generar logs
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Por seguridad, Apache debe apuntar exclusivamente a la carpeta /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Abrimos el puerto 80 para la transmisión
EXPOSE 80
