<?php

namespace Kalider\PhinxTenant\Repositories;

use Kalider\PhinxTenant\Utils\Config;
use Kalider\PhinxTenant\Utils\Database;

abstract class BaseRepository
{
    protected $connection;

    public function __construct()
    {
        if (Config::get('type') == 'array') {
            return;
        }
        
        $this->connection = Database::getConnection();
    }
}
