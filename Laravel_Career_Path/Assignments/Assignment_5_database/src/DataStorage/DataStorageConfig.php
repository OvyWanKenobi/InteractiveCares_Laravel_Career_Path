<?php

namespace App\DataStorage;

class DataStorageConfig
{
    public static function createStorage()
    {
        $storage_option = 'Database'; // 'Database' for store/read from database, or 'File' for json storage
        
        $db_config = [
            'servername' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'lcp_bangubank',
        ];

        if ($storage_option === 'Database') {
            return new MySqliStorage($db_config);
        } else {
            return new JsonStorage();
        }
    }
}
