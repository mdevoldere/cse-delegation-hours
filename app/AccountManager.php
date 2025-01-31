<?php 

define('USERS_FILE', dirname(__DIR__).'/data/members.php');

class AccountManager
{ 
    private static $users = [];

    /**
     * Get all registered users
     * @param bool $withPassword true=encrypted passwords included in result set. false=no password included
     * @return array User list
     */
    public static function getUsers(bool $withPassword = true): array {

        if(empty(self::$users)) {
            self::$users = require_once USERS_FILE;
        }
        
        if(true === $withPassword) {
            return self::$users;
        }

        $t = self::$users;

        foreach($t as $k => $m) {
            unset($t[$k]['password']);
        }

        return $t;
    }

    public static function getUser(string $username, bool $withPassword = true): array {
        $t = self::getUsers($withPassword);

        foreach($t as $m) {
            if($username === $m['username']) {
                return $m;
            }
        }

        throw new Exception('Utilisateur non trouvé', 404);
    }

    public static function loginUser(string $username, string $password) {
        $m = self::getUser($username, true);

        if(password_verify($password, $m['password'])) {
            unset($m['password']);
            return $m;
        }

        throw new Exception('Utilisateur ou mot de passe incorrect', 401);
    }


    /* UTILITIES */

    
    /**
     * Generate Hash from given password
     */
    public static function generatePassword($p): string {
        return password_hash($p, PASSWORD_BCRYPT);
    }

    /**
     * Check if given password match to given hashed password
     */
    public static function verifyPassword($p, $h): bool {
        return password_verify($p, $h);
    }
    
}
