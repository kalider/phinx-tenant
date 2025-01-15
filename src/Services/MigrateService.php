<?php

namespace Kalider\PhinxTenant\Services;

use Phinx\Console\PhinxApplication;

class MigrateService
{
    public static function migrate($tenant, $config)
    {
        $_config = include $config;

        $_config['environments']['default_environment'] = 'production';
        $_config['environments']['production']['host'] = $tenant['host'];
        $_config['environments']['production']['name'] = $tenant['name'];
        $_config['environments']['production']['user'] = $tenant['user'];
        $_config['environments']['production']['pass'] = $tenant['pass'];

        $tempConfigFile = 'phinx_tenant_config.php';
        file_put_contents($tempConfigFile, '<?php return ' . var_export($_config, true) . ';');

        $phinx = new PhinxApplication();

        $wrap = new \Phinx\Wrapper\TextWrapper($phinx, array(
            'parser' => 'php',
            'configuration' => $tempConfigFile,
            'environment' => 'production',
        ));

        try {
            $response = $wrap->getMigrate();
        } catch (\Exception $e) {
            throw $e;
            exit(1);
        }
        finally {
            unlink($tempConfigFile);
        }

        return $response;
    }
}
