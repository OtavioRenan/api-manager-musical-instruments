<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class AutenticationUnauthorizedException extends \Exception
{
    public function __construct($message = "Autenticação não autorizada.", $code = 401, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
