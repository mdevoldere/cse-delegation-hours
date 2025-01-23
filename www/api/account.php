<?php 

require_once '../../app/Api.php';

$d = json_decode(file_get_contents('php://input'), true);

if(empty($d['username']) || empty($d['password'])) {
    APi::error(404, 'Utilisateur ou mot de passe incorrect.');
}

$t = require_once '../../data/members.php';

foreach($t as $m) {
    if($d['username'] === $m['username']) {
        if(password_verify($d['password'], $m['password'])) {
            unset($m['password']);
            Api::response(200, $m);
        }
    }
}

APi::error(401, 'Utilisateur ou mot de passe incorrect.');
