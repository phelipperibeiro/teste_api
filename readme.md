
## Configuração do Banco de Dados
 <br/> <br/>
criar um banco de dados e atualizar o arquivo de configuracao .env da aplicacao com 
as informacoes para conexao do mesmo, segue modelo abaixo: <br/>

DB_CONNECTION=mysql  <br/>
DB_HOST=127.0.0.1  <br/>
DB_PORT=3306  <br/>
DB_DATABASE=leroyDb  <br/>
DB_USERNAME=root  <br/>
DB_PASSWORD=123456  <br/>

## Instalando Dependências
 <br/> <br/>
composer install  <br/>
php artisan migrate --seed  <br/>
 
## Rodando Aplicação 
 <br/> <br/>
php artisan server (para rodar aplicacao)  <br/>
php artisan queue:listen (para escutar os processos que cai na fila)  <br/>


## Leroy API  
<br/> <br/>
[GET:] <a HREF="http://localhost:8000/api/queue/{queue_name}" TARGET="_blank" > http://localhost:8000/api/queue/{queue_name} </a> <br/> 
[GET:] <a HREF="http://localhost:8000/api/produto/{id}" TARGET="_blank" > http://localhost:8000/api/produto/{id} </a> <br/>
[GET:] <a HREF="http://localhost:8000/api/produtos" TARGET="_blank" > http://localhost:8000/api/produtos </a> <br/>
[PUT:] <a HREF="http://localhost:8000/api/produto/{id}" TARGET="_blank" > http://localhost:8000/api/produto/{id} </a> <br/> 
[DELETE:] <a HREF="http://localhost:8000/api/produto/{id}" TARGET="_blank" > http://localhost:8000/api/produto/{id} </a> <br/> 
[POST:] <a HREF="http://localhost:8000/api//produto-novo-lote" TARGET="_blank" > http://localhost:8000/api//produto-novo-lote </a> <br/>