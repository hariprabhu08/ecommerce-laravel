build:
	docker compose build

up:
	docker compose up

restart:
	make rm
	make build
	make up

down:
	docker compose down

rm:
	docker rm ecommmerce-backend ecommmerce-db
	docker rmi ecommerce-laravel-backend
