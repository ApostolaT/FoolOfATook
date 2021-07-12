<?php


namespace FoolOfATook\Exception;


use Throwable;

class CannotWriteToFileException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}