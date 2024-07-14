<?php
// PHP8.3
declare(strict_types=1);

class AppDomainException extends Exception
{
    public readonly null | bool | int | string | array | object $result;

    public function __construct(string $message = "", null | bool | int | string | array | object $result = null, int $code = 0, ?Throwable $previous = null)
    {
        $this->result = $result;
        parent::__construct($message, $code, $previous);
    }
}
