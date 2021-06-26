## Laravel 8


Autenticação com JWT
https://www.positronx.io/laravel-jwt-authentication-tutorial-user-login-signup-api/

Na próxima etapa, temos que publicar a configuração do pacote, o comando seguinte copia os arquivos JWT Auth da pasta vendor para o arquivo config / jwt.php.
## php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

Para lidar com a criptografia de token, gere uma chave secreta executando o seguinte comando.

## php artisan jwt:secret