<?php
declare(strict_types=1);

namespace App\Http\Exceptions;

class InstrumentExistsException extends \Exception
{
    public function __construct($message = "Instrumento não encontrado.", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
