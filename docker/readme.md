# How to run
docker build -t php-mvc ./docker
docker run -d --rm -p 8000:80 --name php-mvc -v "$PWD":/var/www php-mvc
docker exec -it php-mvc composer install

# How to run
docker compose up -d
docker compose stop
docker compose down