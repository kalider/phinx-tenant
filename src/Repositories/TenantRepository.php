<?php

namespace Kalider\PhinxTenant\Repositories;

use Kalider\PhinxTenant\Utils\Config;

class TenantRepository extends BaseRepository
{
    public function getTenants(): array
    {
        $configs = Config::get('database');
        $fields = $configs['fields'];

        $wheres = '';
        if (isset($configs['conditions']) && !empty($configs['conditions'])) {
            $wheres = ' WHERE ' . implode(' AND ', array_map(function ($key) {
                return "{$key} = :{$key}";
            }, array_keys($configs['conditions'])));
        }

        $stmt = $this->connection->prepare("SELECT {$fields['host']} as `host`, {$fields['name']} as `name`, {$fields['user']} as `user`, {$fields['pass']} as `pass` FROM {$configs['table']} " . $wheres);
        $stmt->execute($configs['conditions'] ?? null);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
