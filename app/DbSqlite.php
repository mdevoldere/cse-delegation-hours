<?php

class DbSqlite 
{
    private static ?PDO $db = null;

    /**
     * Get Sqlite PDO instance
     */
    public static function get(): PDO
    {
        if(null === self::$db) {
            try {
                $file = (dirname(__DIR__).'/data/cse.db');
                self::$db = new PDO($file, 'charset=utf8');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                //self::$db->exec('pragma synchronous = off;');
            } catch(Exception $e) {
                throw new Exception('Base de données indisponible');
            }
        }
        
        return self::$db;
    }
}
