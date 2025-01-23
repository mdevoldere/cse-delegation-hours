<?php 

require_once '../../app/Api.php';

$t = require_once '../../data/members.php';

foreach($t as $k => $m) {
    unset($t[$k]['password']);
}

if(!empty($_GET['u'])) {
    $d = $_GET['u'];

    foreach($t as $m) {
        if($d === $m['username']) {
            Api::response(200, $m);
        }
    }
    APi::error(401, 'Utilisateur inexistant.');
}

Api::response(200, $t);
