1. copiar .env.example a .env y docker-compose.yml.example a docker-compose.yml
2. eliminar contenedores de mysql del docker-compose (opcional pero funciona mejor si corren mysql fuera de docker)
3. modificar .env
	a. modificar DB_HOST a host.docker.internal
	b. modificar APP_ENV a development
	c. modificar APP_DEBUG a true
4. ejecutar docker compose build
5. ejecutar docker compose up -d
6. ejecutar docker compose exec app bash
7. dentro del contenedor ejecutar 
	a. composer install
	b. npm install
	c. php artisan migrate
	d. php artisan db:seed
	f. php artisan db:seed --class=InitialSeeder
	g. php artisan db:seed --class=GodSeeder
	h. php artisan key:generate
	i. exit
8. Ahora fuera del contenedor ejecutar docker compose restart
9. ejecutar docker compose exec app bash
10. dentro del contenedor ejecutar npm run dev
11. acceder a localhost/ en buscador
12. ingresar usuario cs@cs.com.gt con cservice