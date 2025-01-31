<?php 

try {
    require_once '../../app/Loader.php';

    if(!empty($_GET['u'])) {
        $d = trim($_GET['u']);
        $t = AccountManager::getUser($d, false);
    } else {
        $t = AccountManager::getUsers(false);
    }

    Api::response(200, $t);
}
catch(Exception $e) {
    APi::error($e->getCode(), $e->getMessage());
}
