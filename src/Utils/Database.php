<?php

namespace Kalider\PhinxTenant\Utils;

class Database
{
    private static ?\PDO $pdo = null;

    public static function getConnection(): \PDO
    {
        if (self::$pdo == null) {
            // create new PDO
            $configs = Config::get('database');
            try {
                self::$pdo = new \PDO(
                    $configs['connection']['adapter'] . ':host=' . $configs['connection']['host'] . ';dbname=' . $configs['connection']['name'],
                    $configs['connection']['user'],
                    $configs['connection']['pass']
                );

                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                error_log($e->getMessage());
            }
        }

        return self::$pdo;
    }

    public static function beginTransaction()
    {
        self::$pdo->beginTransaction();
    }

    public static function commitTransaction()
    {
        self::$pdo->commit();
    }

    public static function rollbackTransaction()
    {
        self::$pdo->rollBack();
    }
}
