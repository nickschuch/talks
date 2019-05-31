build: containers gen

IMAGE_GO="nickschuch/dg2017-grpc-go:latest"
IMAGE_PHP="nickschuch/dg2017-grpc-php:latest"
CODE_GO="gen/go"
CODE_PHP="gen/php"
DOCKER_RUN=docker run -it -w /data -v $(PWD):/data

build: containers gen copy

containers:
	docker build -t $(IMAGE_GO) containers/go
	docker build -t $(IMAGE_PHP) containers/php

gen:
	mkdir -p $(CODE_GO) $(CODE_PHP)
	$(DOCKER_RUN) $(IMAGE_GO) /bin/bash -c 'protoc -I . articles.proto --go_out=plugins=grpc:$(CODE_GO)'
	$(DOCKER_RUN) $(IMAGE_PHP) /bin/bash -c 'protoc -I . articles.proto --php_out=$(CODE_PHP) --grpc_out=$(CODE_PHP) --plugin=protoc-gen-grpc=/usr/local/bin/grpc_php_plugin'

copy:
	rsync -avz $(CODE_GO)/* ../api/src/github.com/nickschuch/articles/
	rsync -avz $(CODE_PHP)/* ../site1/src/
	rsync -avz $(CODE_PHP)/* ../site2/src/

.PHONY: containers gen	
