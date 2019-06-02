php-server:
	cd api/public; \
	php -S 127.0.0.1:8082

front-server:
	cd frontend; \
	sudo npm run serve

mailhog:
	mailhog

app-up:	php-server front-server mailhog