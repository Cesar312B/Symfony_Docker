FROM php:7.4-fpm

RUN apt-get update && apt-get install -y

RUN apt-get update && apt-get install -y --no-install-recommends \
        acl \
        libcurl4-openssl-dev \
        procps \
        zip \
        unzip \
        wget \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \        
    docker-php-ext-install \    
        gd \
        zip \
        intl \
        mysqli \
        pdo \
        pdo_mysql \
        xml \
        curl \
        mbstring \
        opcache

RUN pecl install xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
COPY ./docker/opcache/opcache.ini $PHP_INI_DIR/conf.d/ddocker-php-ext-opcache.ini
WORKDIR /var/www/symfony


