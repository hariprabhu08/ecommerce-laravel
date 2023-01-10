build:
	docker compose build

up:
	docker compose up

restart:
	make rm
	make build
	make up

stop:
	docker compose stop

down:
	docker compose down

rm:
	docker rm ecommerce-backend ecommerce-db
	docker rmi ecommerce-laravel-backend
