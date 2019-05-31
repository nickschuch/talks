FROM php:7.0-cli

RUN apt-get update && \
    apt-get install -y git \
                       build-essential \
                       automake \
                       libtool \
                       autoconf \
                       libssl-dev \
                       zlib1g-dev \
                       libgoogle-perftools-dev \
                       libprotobuf-dev

RUN git clone --depth=1 https://github.com/grpc/grpc && \
      cd grpc && git submodule update --init && \
      make grpc_php_plugin && \
      mv bins/opt/grpc_php_plugin /usr/local/bin/grpc_php_plugin && \
      rm -fR /grpc

ADD bin/protoc /usr/local/bin/protoc
RUN chmod a+x /usr/local/bin/protoc
