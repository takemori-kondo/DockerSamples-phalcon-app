<?php
// PHP8.3
declare(strict_types=1);

use Phalcon\Filter\Validation;

class V
{
    public const REGEX_ALNUM_UNDER = '/^[a-zA-Z0-9_]+$/';
    public const REGEX_ALNUM_4_OPERATION = '/^[a-zA-Z0-9+\-*\/]+$/';

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function validate(string $field, array $validators): mixed
    {
        $validation = new Validation();
        foreach ($validators as $validator) {
            $validation->add($field, $validator);
        }
        $invalidMessages = $validation->validate($this->parameters);
        if (0 < count($invalidMessages)) {
            foreach ($invalidMessages as $msg) {
                LogUtil::debug(__METHOD__ . '| ' . $msg);
            }
            throw new AppDomainException("invalid request parameters : '{$field}'");
        }
        return $this->parameters[$field];
    }
}
