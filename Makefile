start:
	@docker-compose up -d
shell:
	@docker-compose exec php /bin/bash
init:
	cp .env.dist .env
	make start
	@docker-compose exec php composer install
	@docker-compose exec php bin/console doctrine:database:drop --force --if-exists
	@docker-compose exec php bin/console doctrine:database:create
	@docker-compose exec php bin/console doctrine:migrations:migrate -n
	@docker-compose exec php bin/console cache:clear
tests:
	@docker-compose exec php php ./vendor/bin/phpunit
correct-permissions:
	sudo chmod -R 777 html/public/media
demo:
	@make start
	@make tests
	@docker-compose exec php bin/console blog:article:create "Vestibulum sed arcu non odio" "examples/article.txt" "examples/test-image.jpg"
	@echo "Test article added to database. Look at http://localhost:8080/rest/articles"
	@echo "You can also add next articles using URL: http://localhost:8080/administration/article/new"