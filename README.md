# Ecommerce API Server
Docker compose to setup php and mysql for Laravel 8.  

Function:
- Cart CRUD
- Auth Signup, Login, Logout
- Checkout
- VIP Discount
- Check Quantity

Demo


## Env
- Ubuntu 22.04
- Docker 20.10.18

### Directory Structure
```sh
ecommerce-laravel
├── ...
├── Makefile
├── Dockerfile
├── docker-compose.yml
├── .env
├── php.ini
└── images
```
- ... : Laravel files. Use [Laravel-8.1.0](https://github.com/laravel/laravel/tree/v8.1.0).
- images : README.md images.

### Images
1. php → php:7.4-fpm-alpine
2. mysql → mysql:5.7.22

### Deployment using Docker
1. Deploy php-fpm, and mysql using Makefile
    ```bash
    make up
    ```
2. Stop all containers
    ```bash
    make stop
    ```
3. Close all containers
    ```bash
    make down
    ```
4. Remove all containers and images
    ```bash
    make rm
    ```
4. Restart (Rebuild all images and containers)
    ```bash
    make restart
    ```

## SQL Structure
export the AQL structure
```sh
docker exec -it ecommmerce-db mysqldump -u root -proot --no-data -d chart > chart.sql
```
draw diagram in [dbdiagram](https://dbdiagram.io/)
![db diagram](./images/db-structure.png)


## Reference
- https://hiskio.com/courses/429/announcements