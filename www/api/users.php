<?php 

try {
    require_once '../../app/Loader.php';

    if(!empty($_GET['u'])) {
        $d = trim($_GET['u']);
        $t = DbSqlite::getUser($d, false);
    } else {
        $t = DbSqlite::getUsers();
    }

    Api::response(200, $t);
}
catch(Exception $e) {
    APi::error($e->getCode(), $e->getMessage());
}
