<?php

class ZzzSample extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $zzz_sample_id;

    /**
     *
     * @var string
     */
    public $zzz_sample_cd;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $kind;

    /**
     *
     * @var integer
     */
    public $lock_version;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var integer
     */
    public $created_by;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var integer
     */
    public $updated_by;

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
