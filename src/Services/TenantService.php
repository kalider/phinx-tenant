<?php

namespace Kalider\PhinxTenant\Services;

use Kalider\PhinxTenant\Repositories\TenantRepository;
use Kalider\PhinxTenant\Utils\Config;

class TenantService
{
    private TenantRepository $tenantRepository;

    public function __construct()
    {
        $this->tenantRepository = new TenantRepository();
    }

    public function getTenants(): array
    {
        $configs = Config::get();
        
        if ($configs['type'] == 'array') {
            return $configs['tenants'];
        }

        return $this->tenantRepository->getTenants();
    }
}
