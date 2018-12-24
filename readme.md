# MUTANT
    
    add project.local to your hosts

    docker network create --gateway 172.18.0.1 --subnet 172.18.0.0/24 mutant-network

    docker-compose up

    docker exec -it -w /mutant mutant_php php artisan migrate
