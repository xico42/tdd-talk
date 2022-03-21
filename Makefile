HAS_DOCKER_AVAILABLE := $(shell command -v docker 2> /dev/null)
ifdef HAS_DOCKER_AVAILABLE
PHP ?= bin/php
PHPDBG ?= bin/phpdbg
COMPOSER ?= bin/composer
WAIT ?= bin/wait
else
PHP ?= php -d "xdebug.mode=off"
PHPDBG ?= php
COMPOSER ?= $(PHP) /usr/bin/composer
WAIT ?= scripts/wait-for-it.sh
endif

.PHONY: setup
setup: env up vendor wait key check

.PHONY: vendor
vendor:
	$(COMPOSER) install

.PHONY: env
env:
	cp .env.example .env

.PHONY: key
key:
	$(PHP) artisan key:generate --ansi

.PHONY: check
check: phpunit phpstan

.PHONY: phpunit
phpunit:
	$(PHP) vendor/bin/phpunit

.PHONY: phpstan
phpstan:
	$(PHP) vendor/bin/phpstan analyse

.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: wait
wait:
	$(WAIT) nginx:80

.PHONY:
tests: phpunit

ide-helper:
	$(PHP) artisan clear-compiled
	$(PHP) artisan ide-helper:generate
	$(PHP) artisan ide-helper:models --write
	$(PHP) artisan ide-helper:meta

.PHONY: php
php:
	docker-compose exec php-fpm bash

.PHONY: tail
tail:
	docker-compose logs -f
