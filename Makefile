start:
	@docker-compose up -d
shell:
	@docker-compose exec php /bin/bash
init:
	cp .env.dist .env
	make start
	@docker-compose exec php composer install
	@docker-compose exec php bin/console cache:clear
tests:
	@docker-compose exec php php ./vendor/bin/phpunit
correct-permissions:
	sudo chmod -R 777 html/public/media
