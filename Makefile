all: test

init: install

install:
	docker-compose -p resume build
	docker-compose -p resume up -d
	docker-compose -p resume exec symfony composer install
	docker-compose -p resume exec symfony npm install
	docker-compose -p resume exec symfony make migrate

start: ## Start the project
	docker-compose -p resume up -d
	@echo "started on http://127.0.0.1:8000/"
	@echo "PMA on http://127.0.0.1:8002/"

stop:
	docker-compose -p resume down --remove-orphans

cc:
	docker-compose -p resume exec symfony bin/console cache:clear

wp-watch: #WebPack Encore Watch
	./node_modules/.bin/encore dev --watch

console: ## Start a symfony console
	docker-compose -p resume exec symfony bash

migrate:
	php bin/console doctrine:database:create --if-not-exists
	php bin/console doctrine:migration:migrate -q

test:
	cp phpunit.xml.dist phpunit.xml
	bin/console doc:schem:up --force
	bin/console doctrine:fixtures:load -n
	bin/phpunit tests/ -v --coverage-clover var/coverage/phpunit.coverage.xml --log-junit var/coverage/phpunit.report.xml

build:
	docker-compose build

docker-compose:
	docker-compose -p resume -f docker/docker-compose.yml pull
	docker-compose -p resume -f docker/docker-compose.yml up -d

asset:
	bin/console assets:install --symlink public
	bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json
	./node_modules/.bin/encore production

build:
	docker build -t resume:latest .
	docker save -o resume.tar resume:latests

.PHONY: test build init
