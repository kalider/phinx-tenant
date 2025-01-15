<?php

namespace Kalider\PhinxTenant\Utils;

class Config
{
    public static function get($key = null)
    {
        $configs = require 'phinx-tenant.php';
        if (is_null($key)) {
            return $configs;
        }

        if (!array_key_exists($key, $configs))
            throw new \Exception("Key $key not found in phinx-tenant.php");

        return $configs[$key];
    }
}
