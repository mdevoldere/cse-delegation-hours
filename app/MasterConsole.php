<?php 

class MasterConsole 
{
    const MASTER_PASSWORD = '$2y$12$jlXd5B9qbFCjoyu3ht5xXeAkhZ7V64DC7eNIjFAl.Fj0UJyTSqZQe';

    public static function prompt($promt): string {
        $input = readline($promt . " ");
        return trim($input);
    }

    public static function loginMaster(): void {
        $tries = 3;

        do {
            $p = self::prompt("Mot de passe Administrateur ?");

            if(AccountManager::verifyPassword($p, self::MASTER_PASSWORD)) {
                echo "Identification OK.\n";
                return;
            }
            $tries--;
            echo 'Mot de passe incorrect (essais restants: '.$tries.'/3).'."\n";
        }
        while($tries > 0);

        exit('Echec de l\'authentification.');
    }
}
