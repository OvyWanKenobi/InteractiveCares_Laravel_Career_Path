<?php

namespace App\DataStorage;


class JsonStorage implements DataStorageInterface
{

    public function getAll($table)
    {

        $filePath = __DIR__ . "/../../File/{$table}.json";
        var_dump($filePath);
        if (file_exists($filePath) && filesize($filePath) > 0) {

            return json_decode(file_get_contents($filePath), true);
        }

        return [];
    }

    public function select($table, $conditions)
    {
        $all_items = $this->getAll($table);
        $filtered_items = [];
        $filtered_items = array_filter($all_items, function ($item) use ($conditions) {
            foreach ($conditions as $key => $value) {
                if ($item[$key] !== $value) {
                    return false;
                }
            }
            return true;
        });

        return $filtered_items;
    }

    public function insert($table, $data)
    {
        $filePath = __DIR__ . "/../../File/{$table}.json";
        $items = $this->getAll($table);
        $items[] = $data;
        file_put_contents($filePath, json_encode($items));
    }
}
