<?php

namespace Kalider\PhinxTenant\Commands;

use Kalider\PhinxTenant\Services\MigrateService;
use Kalider\PhinxTenant\Services\TenantService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends Command
{
    protected TenantService $tenantService;
    protected MigrateService $migrateService;

    public function __construct()
    {
        parent::__construct();
        $this->tenantService = new TenantService();
        $this->migrateService = new MigrateService();
    }

    protected function configure()
    {
        $this
            ->setName("migrate")
            ->addOption('--configuration', '-c', InputOption::VALUE_REQUIRED, 'The configuration file to load')
            ->setDescription('Run the database migrations');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Migrating the database...');

        $config = $input->getOption('configuration') ?? 'phinx.php';

        // Run the migrations
        $tenants = $this->tenantService->getTenants();
        foreach ($tenants as $tenant) {
            $response = $this->migrateService->migrate($tenant, $config);
            $output->writeln($response);
            flush();
        }

        $output->writeln('Database has been migrated successfully.');
        return self::SUCCESS;
    }
}
