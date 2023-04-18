# Laravel API & Vue SPA: Example App  

Welcome to the Laravel+Vue example close to a real SPA-API application.  
Designed for junior developers, show the main points of full stack developing a classic web app with Auth, Roles, CRUD, Service Layer, etc.  
Your application may have a different implementation. Use any code of the app at your own risk 😈.  

## Stack  
- PHP 8.2
- MariaDB 10
- Node 18
- Docker
- Redis
- Laravel 10
- Octane Roadrunner
- Fortify
- Sanctum
- Telescope
- Vue 3
- Vite
- Tailwind CSS
- Font Awesome

### Presetting   
```
cp .env.example .env
```
*The configuration is ready to use and does not require changes.*

### Build with docker
#### ⚠️ Don't use this docker configuration in a real application, just for a quick demo   
```
docker-compose up -d
```
Go to http://localhost:8000

Mailhog: http://localhost:8025  
Database: `localhost:3377`


### Preview
![home page](./preview.jpg?raw=true)
