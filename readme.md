# MUTANT

Is a api for Magneto search for mutants.

## Instalation

add project.local to your hosts file

```bash
127.0.0.1 project local
```

## Run Command for create a docker network
```bash
docker network create --gateway 172.18.0.1 --subnet 172.18.0.0/24 mutant-network
```

## Run docker compose to up containers
```bash
docker-compose up
```

## Run composer
```bash
docker exec -it -w /mutant mutant_php composer install
```

## Run the migration
```bash
docker exec -it -w /mutant mutant_php php artisan migrate
```

## Run the seed command
```bash
docker exec -it -w /mutant mutant_php php artisan db:seed
```

## Run the tests (Will generate a coverage report in folder "reports")
```bash
docker exec -it -w /mutant mutant_php ./vendor/bin/phpunit
```

## Examples
The sample requests are in the folder "postman"
