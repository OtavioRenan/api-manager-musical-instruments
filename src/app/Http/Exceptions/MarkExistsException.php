<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class MarkExistsException extends \Exception
{
    public function __construct($message = "Marca não encontrada.", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
