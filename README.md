# Setup Inicial Para O Projeto
## Passo a Passo

### Clone Repositório
```bash
git clone https://github.com/JoaoVitorJJV/To-do-System-With-Laravel.git
```

### Crie o arquivo .env na pasta do projeto Laravel
```bash
cp .env.example .env
```

### Atualize as variáveis de ambiente no arquivo .env
## O container do docker já fornece o banco de dados "laravel", basta usá-lo no .env
```dotenv
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Atualize a BASE_URL do arquivo vue/src/api/api.js (opcional)
```javascript
const BASE_URL = "http://localhost:8989";
```

### Suba os containers do projeto
```bash
docker-compose up -d
```

### Acesse o container do Laravel
```bash
docker exec -it app bin/bash
```
ou
```bash
docker exec -it To-do-System-With-Laravel-app-1 bin/bash
```

### Rode o comando do composer
```bash
composer install
```

### Rode as migrations
```bash
php artisan migrate
```

