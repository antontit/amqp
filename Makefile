init: api-permissions	php-server front-server mailhog

php-server:
	cd api/public; \
	php -S 127.0.0.1:8082 &

front-server:
	cd frontend; \
	sudo npm run serve
	

api-permissions:
	sudo chmod 777 api/var
	sudo chmod 777 api/var/cache
	sudo chmod 777 api/var/log
	sudo chmod 777 api/var/mail
	sudo chmod 777 api/storage/public/video
	sudo chown 777 api/storage/public/video

mailhog:
	mailhog
