FROM php:8.0-fpm

RUN echo "Started Dockerfile"


RUN echo "Copying composer.json and composer.lock to container"

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

RUN echo "Set WORKDIR"

# Set working directory
WORKDIR /var/www

RUN echo "Installing Dependencies"


RUN echo "Adding docker-php-extension-installer"

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd memcached

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    curl

RUN echo "Clearing apt cache"

# Clear cache
#RUN apt-get clean && rm -rf /var/lib/apt/lists/*


RUN echo "Installing extensions 1"

# Install extensions
#RUN docker-php-ext-install pdo_mysql zip exif pcntl mbstring

RUN echo "Installing extensions 2"

#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/

RUN echo "Installing extensions 3"

#RUN docker-php-ext-install gd

RUN echo "Installing composer"

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "Adding laravel user"

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN echo "Copying stuff"

# Copy existing application directory contents
COPY ../. /var/www


RUN echo "Setting permissions for laravel user"

# Copy existing application directory permissions
COPY --chown=www:www ../. /var/www

# Change current user to www
#USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm"]
