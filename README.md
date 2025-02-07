# CAKE API

API que permite criar, listar, atualizar e deletar bolos. Permite também registar um pedido de bolo. 

Ao criar um pedido, se houver disponibidade, um email é enviado.

**Requisitos**:

- PHP 8.4.3
- Laravel Framework 11.41.3

Por ser um projeto de teste, as seguintes decisões foram tomada:

- SQLite para banco de dados, pois permite iniciar a aplicação rapidamente, sem necessidade de instalação de banco de dados ou docker. 
- Não foi configurado um servidor SMTP para envio de email, porém é possível visualizar nos logs da aplicação sempre que um email é "disparado".

**Rodando a aplicação localmente**

1) Copie o arquivo .env.example para .env
```
cp .env.example .env
```

2) No arquivo .env, Configure a variável `DB_DATABASE` com o caminho para o arquivo do sqlite, como mostra o exemplo abaixo:

```
DB_DATABASE=/Users/eu/code/me/cake-api/database/database.sqlite
````

3) Aplique as migrações do projeto utilizando o artisan:
```
php artisan migrate
```

4) Inicie a aplicação utilizando o artisan:
```
php artisan serve
```

Exemplos de requisições que podem ser executadas:

- Lista Volos
```
curl --location 'http://localhost:8000/api/v1/cakes' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```

- Cria Bolo
```
curl --location 'http://localhost:8000/api/v1/cakes' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "name": "Bolo de coco",
    "price": 100.90,
    "weight": 320,
    "quantity": 100
}'
```

- Busca Bolo
```
curl --location 'http://localhost:8000/api/v1/cakes/1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```

- Deleta Bolo
```
curl --location --request DELETE 'http://localhost:8000/api/v1/cakes/1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```

- Atualiza Bolo
```
curl --location --request PUT 'http://localhost:8000/api/v1/cakes/1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "name": "Bolo de coco",
    "price": 100.90,
    "weight": 320,
    "quantity": 100
}'
```


- Cria pedido de bolo
```
curl --location 'http://localhost:8000/api/v1/orders' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "alou@teste.com.br",
    "cake_id": 1
}'
```

- Lista pedidos de bolos
```
curl --location --request GET 'http://localhost:8000/api/v1/orders' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```

**Rodando testes localmente**

2) No arquivo .env.testing, Configure a variável `DB_DATABASE` com o caminho para o arquivo do sqlite de teste, como mostra o exemplo abaixo:

```
DB_DATABASE=/Users/eu/code/me/cake-api/database/database_test.sqlite
````