FROM 166656354036.dkr.ecr.us-east-1.amazonaws.com/docker-images/php:8.4-fpm-xdebug3.5

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --version=2.9.5 --quiet

WORKDIR /var/www
