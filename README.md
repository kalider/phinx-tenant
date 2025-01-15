# Kalaider Phinx Multi-Tenant

This project is a multi-tenant implementation using the Phinx library for database migrations.

## Installation

To install the library, use Composer:

```bash
composer require kalider/phinx-tenant
```

## Usage

### Configuration

Create a `phinx-tenant.php` configuration file in the root of your project:

```php

return [
    'type' => 'database', // database, array
    // if database type
    'database' => [
        'connection' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'multi_tenant_db',
            'user' => 'root',
            'pass' => 'kudabelang',
        ],
        'table' => 'tenants',
        'fields' => [
            'host' => 'host',
            'name' => 'name',
            'user' => 'user',
            'pass' => 'pass',
        ],
        // if wheres condition 
        'conditions' => [
            'status' => 1
        ]
    ],
    // if array type
    'tenants' => [
        [
            'host' => 'localhost',
            'name' => 'tenant1',
            'user' => 'root',
            'pass' => 'root',
        ],
    ]
];

```

### Running Migrations

To run migrations for a specific tenant, use the following command:

```bash
php vendor/bin/phinx-tenant migrate

# different phinx config
php vendor/bin/phinx-tenant migrate -c phinx-master.php
```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any changes.

## Contact

For any questions or inquiries, please contact [new.m.tah@gmail.com](mailto:new.m.tah@gmail.com).