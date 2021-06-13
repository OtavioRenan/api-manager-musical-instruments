<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class AutenticationPasswordExistsException extends \Exception
{
    public function __construct($message = "Senha inválida.", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
