

### Frontend

#### Para utilizar o frontend da aplicação basta entrar na sua respectiva pasta e segui os passos:

- Tenha o docker/docker compose instalado em sua máquina
>Execute docker-compose up -d --build

- A aplicação estará disponível na porta 5000
### Backend

#### Para utilizar o backend da aplicação basta entrar na sua respectiva pasta e segui os passos:

- Tenha o composer instalado em sua máquina e o mysql
> Renomei o aquivo .env.example para apenas .env <br />
> Execute composer install <br />
> Execute php artisan key:generate <br />
> Execute php artisan jwt:secret <br />
> Execute php artisan migrate --seed <br />
> Execute php artisan serve

