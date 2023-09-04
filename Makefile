.PHONY: assets

init: deps database fixtures assets

permissions:
	setfacl -R -m u:www-data:rwX var/
	setfacl -dR -m u:www-data:rwX var/

permissions-dev:
	sudo setfacl -R -m u:$(USER):rwX ./
	sudo setfacl -dR -m u:$(USER):rwX ./

_deps:
	composer install --no-interaction --no-ansi --no-progress --prefer-dist
	yarn install --force
deps:
	docker compose exec web make _deps

_database:
	bin/console doctrine:database:create --if-not-exists --no-interaction --env=prod
	bin/console doctrine:migration:migrate --no-interaction --env=prod
database:
	docker compose exec --user=www-data web make _database

_fixtures:
	bin/console doctrine:fixture:load --quiet
fixtures:
	docker-compose exec web bin/console doctrine:fixture:load --quiet

_assets:
	npm run build
assets:
	docker compose exec web make _assets

assets-dev:
	docker compose exec web npm run watch
