<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class ModelExistsException extends \Exception
{
    public function __construct($message = "Modelo não encontrado.", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
