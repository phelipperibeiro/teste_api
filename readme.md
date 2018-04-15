
## Configuração do Banco de Dados

criar um banco de dados e atualizar o arquivo de configuracao .env da aplicacao com 
as informacoes para conexao do mesmo, segue modelo abaixo

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leroyDb
DB_USERNAME=root
DB_PASSWORD=123456

## Instalando Dependências

composer install
php artisan migrate --seed

## Rodando Aplicação

php artisan server (para rodar aplicacao)
php artisan queue:listen (para escutar os processos que cai na fila)


## Leroy API

[GET: http://localhost:8000/api/queue/{queue_name}]
[GET: http://localhost:8000/api/produto/{id}]
[GET: http://localhost:8000/api/produtos]
[PUT: http://localhost:8000/api/produto/{id}]
[DELETE: http://localhost:8000/api/produto/{id}]
[POST: http://localhost:8000/api//produto-novo-lote]