####################################
# Stage 1: Base Stage
####################################

FROM php:8.2-fpm-alpine AS base

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apk update && apk add --no-cache \
  bash \
  build-base \
  autoconf \
  linux-headers \
  freetype-dev \
  jpeg-dev \
  libpng-dev \
  libzip-dev \
  nodejs \
  npm \
  supervisor \
  git \
  curl \
  oniguruma-dev \
  && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

####################################
# Stage 2: Dependencies Stage
####################################

FROM base AS dependencies

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --prefer-dist --no-scripts --no-autoloader

# Copy package.json and package-lock.json
COPY package.json package-lock.json ./

# Install NPM dependencies
RUN npm ci

####################################
# Stage 3: Development Stage
####################################

FROM base AS development

ENV APP_ENV=local

# Install additional PHP extensions for development
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Copy existing application directory contents
COPY . .

# Copy dependencies from the dependencies stage
COPY --from=dependencies /var/www/vendor /var/www/vendor
COPY --from=dependencies /var/www/node_modules /var/www/node_modules

# Set permissions for the Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Generate optimized autoload files
RUN composer dump-autoload --optimize

# Copy the entrypoint script
COPY ./docker-entrypoint.sh /usr/local/bin/

# Make the entrypoint script executable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 3000

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["php", "artisan", "serve", "--port=3000", "--host=0.0.0.0"]

####################################
# Stage 4: Production Stage
####################################

FROM base AS production

ENV APP_ENV=production

# Copy existing application directory contents
COPY . .

# Copy dependencies from the dependencies stage
COPY --from=dependencies /var/www/vendor /var/www/vendor
COPY --from=dependencies /var/www/node_modules /var/www/node_modules

# Set permissions for the Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Generate optimized autoload files
RUN composer dump-autoload --optimize

# Copy the entrypoint script
COPY ./docker-entrypoint.sh /usr/local/bin/

# Make the entrypoint script executable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port 3000 and start php-fpm server
EXPOSE 3000

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["php", "artisan", "serve", "--port=3000", "--host=0.0.0.0"]