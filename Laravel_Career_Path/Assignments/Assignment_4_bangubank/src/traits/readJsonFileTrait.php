<?php

namespace App\Traits;

trait readJsonFileTrait
{
    private function readJsonFileContent($filePath)
    {
        if (file_exists($this->filePath) && filesize($this->filePath) > 0) {
            return json_decode(file_get_contents($this->filePath), true);
        }
        return [];
    }
}
