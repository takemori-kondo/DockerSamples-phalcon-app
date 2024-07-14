<?php

class ZzzSample extends \Phalcon\Mvc\Model
{

    public ?int $zzz_sample_id = null;
    public string $zzz_sample_cd = "";
    public string $name = "";
    public string $kind = "";
    public ?int $lock_version = null;
    public ?string $created_at = null;
    public ?int $created_by = null;
    public ?string $updated_at = null;
    public ?int $updated_by = null;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("common");
        $this->setSource("zzz_sample");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZzzSample[]|ZzzSample|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZzzSample|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
