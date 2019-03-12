FROM previousnext/php:7.0-dev

RUN apt-get update && \
    apt-get -y install zlib1g-dev

RUN pecl install grpc && \
    echo 'extension=grpc.so' >> /usr/local/etc/php/php.ini
