<?php
// PHP8.3
declare(strict_types=1);

use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Di\Di;
use Phalcon\Mvc\Model;

class PhalconDbUtil
{
    public static function queryBySql(string $sql, array $params, ?AdapterInterface $db = null): array
    {
        if ($db === null) {
            /** @var AdapterInterface */
            $db = Di::getDefault()->get('db');
        }
        $ri = $db->query($sql, $params);
        $results = $ri->fetchAll();
        return $results;
    }

    public static function executeBySql(string $sql, array $params, ?AdapterInterface $db = null): int
    {
        if ($db === null) {
            /** @var AdapterInterface */
            $db = Di::getDefault()->get('db');
        }
        $db->execute($sql, $params);
        $count = $db->affectedRows();
        return $count;
    }

    public static function assignCommonPropertiesForCreate(Model $model, int $login_id, ?string $datetime = null): void
    {
        if ($datetime === null) {
            $datetime = date('Y-m-d H:i:s');
        }
        $model->lock_version = 1;
        $model->created_at = $datetime;
        $model->created_by = $login_id;
        $model->updated_at = $datetime;
        $model->updated_by = $login_id;
    }

    public static function getCommonPropertiesPartsForUpdate(int $lock_version, int $login_id, ?string $datetime = null): CommonPropertiesParts
    {
        if ($datetime === null) {
            $datetime = date('Y-m-d H:i:s');
        }
        $parts = new CommonPropertiesParts();
        $parts->setParts = <<<'HEREDOC'
    , lock_version = :lock_version + 1
    , updated_at = :updated_at
    , updated_by = :updated_by
HEREDOC;
        $parts->whereParts = <<<'HEREDOC'
    AND lock_version = :lock_version
HEREDOC;
        $parts->paramParts = [
            'lock_version' => $lock_version,
            'updated_at' => $datetime,
            'updated_by' => $login_id
        ];
        return $parts;
    }
}
