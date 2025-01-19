<?php

class Api 
{
    /**
     * Set JSON HTTP Response
     * @param int $c HTTP Response Code
     * @param string|array $d HTTP Response Body
     * @return never
     */
    public static function response(int $c, mixed $d): never {
        header('Access-Control-Allow-Headers: access-control-allow-origin');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT');
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($c);
        if(is_array($d)) { $d = self::toJson($d); }
        echo trim($d);
        exit;
    }

    /**
     * Set Error HTTP Response
     * @param int $c HTTP Response Code
     * @param string|array $m Error Message
     * @return never
     */
    public static function error(int $c, mixed $m): never {
        self::response($c, ['error' => $m]);
    }
    
    public static function r(mixed $v): void { self::response(200, $v); }
    public static function e(mixed $v): void { self::error(404, $v); }

    public static function toJson(mixed $d): string {
        return json_encode($d, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }
}
