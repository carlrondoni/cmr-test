# Microservice Symfony Test

## Stack

* Docker (nginx + php 7.4 + mysql 8 + phpmyadmin)

* Symfony 5.4 (api-platform + jwt + cors + doctrine extensions + phpunit + maker)

## Requirements

Installed locally you will need:

* docker

* docker compose


## Init

1. git clone this repo

2. inside the folder of the project : ```docker-compose up -d --build```

3. after you need to connect to php container : ```docker exec -it ms-test-php bash```

4. init and initial set up of the platform : ```composer first```

## Endpoints

Use postman and import cmr-test.postman_collection.json file for the endpoints you can use.