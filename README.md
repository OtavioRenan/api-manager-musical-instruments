Um simples sisteminha para cadastro de instrumentos.

Nesse sistema eu tentei utilizar toda a minha expertise em PHP utilizando o PHPUnit para a prática de TDD. Utilizando as factorys em memória é possível ver os teste rodar sem mesmo ter um banco vinculado ao projeto.
Vale apena também ressaltar a minha tentativa de usar o Clean Code para manter meu código mais sucinto.
Esse projeto também foi utilizado para melhorar meu conhecimento em Docker.

Tecnologias:
    Git-Flow
        Docker
            Container
                MySQL
                Ngix
                    Laravel (PHP 7.4)
                        Sistema de log com Traits
                        PHPUnit para TDD
                        Camada de Repositório e Serviço
                        Tratamentos de erros
                    JWT
                        Autenticação

Para executar o projeto é necessário copiar o arquivo yml no diretório phpdocker/Docker-Compose-Files para o diretório raiz e remover o nome de ambiente do arquivo.
# Arquivos do docker-compose.yml no diretório phpdocker/Docker-Compose-Files

Também copie o arquivo .env que está no diretório phpdocker/Environments-Files para o diretório src/ e remova o nome de ambiente do arquivo. Lembrand que o arquivo .env é aonde ficam as configuraçoes de ambiente do projeto.
# Arquivos .env no diretório phpdocker/Environments-Files

Execute os comando docker apra subir o container:
# docker-compose up -d

Instale as dependências do laravel executando o PHP do dontainers:
# docker-compose exec php-fpm composer install

Pronto!! As dependências foram instaladas, executando o próximo comando você consegue ver os testes do projeto rodando:

# docker-compose exec php-fpm php artisan test