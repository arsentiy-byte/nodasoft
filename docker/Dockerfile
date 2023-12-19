FROM php:8.2-fpm

RUN apt-get update -yqq \
    && apt-get install -y --no-install-recommends \
      procps \
      build-essential \
      libpng-dev \
      libaio1 \
      libjpeg62-turbo-dev \
      libfreetype6-dev \
      locales \
      zip \
      jpegoptim optipng pngquant gifsicle \
      vim \
      libzip-dev \
      unzip \
      git \
      libonig-dev \
      curl \
      g++ \
      libicu-dev \
      libpq-dev \
      lftp \
      wget \
      zlib1g-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install intl opcache pdo pdo_pgsql pgsql mbstring zip exif pcntl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable opcache redis \
    && docker-php-ext-install gd

WORKDIR /var/www

COPY --chown=www-data:www-data ./ /var/www

RUN mkdir /var/www/vendor && chown www-data:www-data -R /var/www && \
    composer install && \
    chmod -R +x vendor/bin/* || true

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

CMD ["/usr/local/bin/entrypoint"]
