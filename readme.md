## Configuração do Banco de Dados
criar um banco de dados e atualizar o arquivo de configuracao .env da aplicacao com 
as informacoes para conexao do mesmo, segue modelo abaixo: <br/>

DB_CONNECTION=mysql  <br/>
DB_HOST=127.0.0.1  <br/>
DB_PORT=3306  <br/>
DB_DATABASE=leroyDb  <br/>
DB_USERNAME=root  <br/>
DB_PASSWORD=123456  <br/>

## Instalando Dependências
composer install  <br/>
php artisan migrate --seed  <br/>
 
## Rodando Aplicação 
php artisan server (para rodar aplicacao)  <br/>
php artisan queue:listen (para escutar os processos que cai na fila)  <br/>

## Leroy API  
<br>
Se optar por importar collection, segue link abaixo
<br>
https://www.getpostman.com/collections/98a045e690d5601f7f31
<br>
<br>
[GET:] <a HREF="http://localhost:8000/api/queue/{queue_name}" TARGET="_blank" > http://localhost:8000/api/queue/{queue_name} </a>: pegar status de um determinado processo na fila<br/> 
[GET:] <a HREF="http://localhost:8000/api/produto/{id}" TARGET="_blank" > http://localhost:8000/api/produto/{id} </a>: pegar um determinado produto pelo ID do banco <br/>
[GET:] <a HREF="http://localhost:8000/api/produtos" TARGET="_blank" > http://localhost:8000/api/produtos </a>: pegar todos os produtos <br/>
[PUT:] <a HREF="http://localhost:8000/api/produto/{id}" TARGET="_blank" > http://localhost:8000/api/produto/{id} </a>: atualizar um determinado produto pelo ID do mesmo <br/> 
[DELETE:] <a HREF="http://localhost:8000/api/produto/{id}" TARGET="_blank" > http://localhost:8000/api/produto/{id} </a> deletar um determinado produto pelo ID do mesmo <br/>  
[POST:] <a HREF="http://localhost:8000/api//produto-novo-lote" TARGET="_blank" > http://localhost:8000/api/produto-novo-lote </a> cadastrar produtos em lote, arquivo excel com extensões ('xlsx','xls')<br/>

## TDD
<br>
Para rodar todos os testes, favor executar comando abaixo no bash
<br>
vendor/bin/phpunit -c  phpunit.xml
