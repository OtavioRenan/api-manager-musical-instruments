## Docker
## Laravel 8

## Angular 11

/------------------- EXECUÇÃO A PARTIR DO DOCKER ---------------------------/

Informações sobre implementação do pojeto laradock-dog-register:

Copie o arquivo .env.example para .env na pasta raiz. Você pode digitar copy .env.example .env se estiver usando o comando Prompt Windows ou cp .env.example .env se estiver usando o terminal linux. O arquivo já esta configurado. Como não houve uma exigência dei preferência ao uso do banco MySQL.

Execute o comando para rodar o container:

docker-compose up
É necessário instalar as dependecias do composer com o comando

docker-compose exec app composer install
Gere o a chave do arquivo .env

docker-compose exec app php artisan key:generate
Para criar as tabelas execute o comando

docker-compose exec app php artisan migrate
/------------------- EXECUÇÃO A PARTIR DO DOCKER ---------------------------/

É necessário a criação de um banco, apos a criação faz-se necessário o registro dele no arquivo .env
-- DB_CONNECTION=mysql
-- DB_HOST=127.0.0.1
-- DB_PORT=3306
-- DB_DATABASE=nome_do_banco
-- DB_USERNAME=usuario_do_banco
-- DB_PASSWORD=senha_do_usuario
