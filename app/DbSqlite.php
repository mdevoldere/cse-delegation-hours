<?php

class DbSqlite 
{
    private static ?PDO $_db = null;

    /**
     * Get Sqlite PDO instance
     */
    private static function db(): PDO
    {
        if(null === self::$_db) {
            try {
                $file = (dirname(__DIR__).'/data/cse.db');
                self::$_db = new PDO('sqlite:'.$file, 'charset=utf8');
                self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                //self::$db->exec('pragma synchronous = off;');
            } catch(Exception $e) {
                throw new Exception('Base de données indisponible. ' . $e->getMessage());
            }
        }
        
        return self::$_db;
    }

    public static function login(string $u, string $p): array {
        try {
            $u = self::getUser($u, true);

            if(!empty($u['pwd'])) {
                if(password_verify($p, $u['pwd'])) {
                    unset($u['pwd']);
                    return $u;
                }
            }

            throw new Exception('Utilisateur ou mot de passe incorrect');
        }
        catch(Exception $e) {
            throw new Exception('. ' . $e->getMessage());
        }
    }

    public static function getUser(string $u, bool $withPwd = false): array {
        try {
            $stmt = self::db()->prepare(
                "SELECT id, adm, lastname, firstname, pwd, m_titular, m_mid, m_start, m_end, m_actual_start, m_actual_end 
                FROM users
                JOIN users_mandates ON users.id = users_mandates.m_uid 
                JOIN mandates ON users_mandates.m_mid = mandates.m_id
                WHERE id=:id 
                ORDER BY m_mid DESC LIMIT 1"
            );

            if($stmt->execute([':id' => $u])) {
                $u = $stmt->fetch();
                if(false === $withPwd) {
                    unset($u['pwd']);
                }
                return $u;
            }

            return [];
        }
        catch(Exception $e) {
            throw new Exception('Erreur BDD User. ' . $e->getMessage());
        }
    }

    public static function getUsers(): array {
        try {

        }
        catch(Exception $e) {
            throw new Exception('. ' . $e->getMessage());
        }
        
        return [];
    }

    public static function getMandates(): array {
        try {

        }
        catch(Exception $e) {
            throw new Exception('. ' . $e->getMessage());
        }
        
        return [];
    }
}
