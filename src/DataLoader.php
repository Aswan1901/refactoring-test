<?php

namespace App;

class DataLoader{
    public static function loadData($filePath): array
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File not found");
        }

        $result = [];

        if (($handle = fopen($filePath, 'r')) !== false){
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false){
                $result[] = array_combine($header, $data);
            }
            fclose($handle);
        }
        return $result;
    }
}