<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class InstrumentTypeExistsException extends \Exception
{
    public function __construct($message = "Tipo de instrumento não encontrado.", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
