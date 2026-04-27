<?php

/**
 * app/Config/Database.php
 * CodeIgniter 4 Database Configuration
 * PC21 Advanced Web Development | Terminal Assessment 1
 *
 * Update the credentials below to match your local MySQL setup.
 */

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * Default database connection — update credentials here.
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',   // ← Your DB host (usually localhost / 127.0.0.1)
        'username'     => 'root',        // ← Your MySQL username
        'password'     => '',            // ← Your MySQL password
        'database'     => 'eis_db',      // ← Must match the DB created in employees_table.sql
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,          // Set to false in production
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_unicode_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
    ];

    /**
     * Test environment database (optional).
     */
    public array $tests = [
        'DSN'          => '',
        'hostname'     => '127.0.0.1',
        'username'     => 'root',
        'password'     => '',
        'database'     => 'eis_db_test',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_unicode_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
    ];
}