<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class AutenticationUserExistsException extends \Exception
{
    public function __construct($message = "Usuário inválido.", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
