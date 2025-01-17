<?php 

class Api 
{
    public static function toJson(mixed $d): string {
        return json_encode($d, JSON_PRETTY_PRINT|JSON_NUMERIC_CHECK|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }

    public static function toJsonExit(mixed $d): never {
        echo self::toJson($d);
        exit;
    }

    public static function toJsonError(string $message): never {
        self::toJsonExit(['error' => $message]);
    }
}
