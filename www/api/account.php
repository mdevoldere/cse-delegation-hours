<?php 

try {
    require_once '../../app/Loader.php';

    $d = json_decode(file_get_contents('php://input'), true);

    if(empty($d['username']) || empty($d['password'])) {
        throw new Exception('Utilisateur ou mot de passe incorrect.', 404);
    }

    $m = AccountManager::loginUser($d['username'], $d['password']);

    Api::response(200, $m);
}
catch(Exception $e) {
    APi::error($e->getCode(), $e->getMessage());
}
