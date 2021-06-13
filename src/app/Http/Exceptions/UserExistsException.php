<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class UserExistsException extends \Exception
{
    public function __construct($message = "Usuário não encontrado.", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
