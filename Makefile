lint:
	composer run-script phpcs -- --standard=PSR2 routes tests
test:
	phpunit
	php artisan dusk
install:
	composer install
run:
	php -S localhost:8000 -t public
logs: 
	tail -f storage/logs/laravel.log
deploy:
	git push heroku master
	heroku run php artisan migrate
github:
	git push -u origin master
jobs:
	php artisan queue:work --once