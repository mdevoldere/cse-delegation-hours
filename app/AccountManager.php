<?php 

require_once 'MasterConsole.php';

class AccountManager
{ 
    const MASTER_PASSWORD = '$2y$12$jlXd5B9qbFCjoyu3ht5xXeAkhZ7V64DC7eNIjFAl.Fj0UJyTSqZQe';

    public static function loginMaster(): void {
        $tries = 3;

        do {
            $p = MasterConsole::prompt("Mot de passe Administrateur ?");

            if(self::verifyPassword($p, self::MASTER_PASSWORD)) {
                echo "Identification OK.\n";
                return;
            }
            $tries--;
            echo 'Mot de passe incorrect (essais restants: '.$tries.'/3).'."\n";
        }
        while($tries > 0);

        exit('Echec de l\'authentification.');
    }

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

    public static function getAccount($username) {

    }

    
}
