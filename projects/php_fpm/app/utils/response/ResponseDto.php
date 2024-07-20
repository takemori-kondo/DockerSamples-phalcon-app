<?php
// PHP8.3
declare(strict_types=1);

class ResponseDto
{
    public readonly ?ErrorDto $error;
    public readonly null | bool | int | string | array | object $result;

    public function __construct(?ErrorDto $error = null, null | bool | int | string | array | object $result = null)
    {
        $this->error = $error;
        $this->result = $result;
    }
}
