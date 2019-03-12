#!/usr/bin/make -f

start: up deps install modules open

up:
	docker-compose up --build -d

deps:
	docker-compose exec site1 /bin/bash -c 'composer install --prefer-dist --no-progress && composer drupal-scaffold'
	docker-compose exec site2 /bin/bash -c 'composer install --prefer-dist --no-progress && composer drupal-scaffold'

install:
	docker-compose exec site1 /bin/bash -c 'drush site-install -y --site-name="Dept. of Awesome" --account-pass=password standard && chown -R www-data:www-data app'
	docker-compose exec site2 /bin/bash -c 'drush site-install -y --site-name="Dept. of Cool" --account-pass=password standard && chown -R www-data:www-data app'

modules:
	# Have returned true because of 'make: *** [modules] Error 129'
	docker-compose exec site1 /bin/bash -c 'drush en -y remote_article || true'
	docker-compose exec site2 /bin/bash -c 'drush en -y remote_article || true'

open:
	xdg-open http://localhost:9000
	xdg-open http://localhost:8081
	xdg-open http://localhost:8082

seed:
	docker-compose exec api /bin/sh -c 'seed'

list:
	docker-compose exec api /bin/sh -c 'list'
