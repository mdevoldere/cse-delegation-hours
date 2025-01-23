<?php 

require_once '../../app/Api.php';

$d = json_decode(file_get_contents('php://input'), true);

if(empty($d['username']) || empty($d['password'])) {
    APi::error(401, 'Utilisateur ou mot de passe incorrect (1).');
}

$t = require_once '../../data/members.php';

if(!array_key_exists($d['username'], $t)) {
    APi::error(401, 'Utilisateur ou mot de passe incorrect (2).');
}

$m = $t[$d['username']];

if(!password_verify($d['password'], $m['password'])) {
    APi::error(401, 'Utilisateur ou mot de passe incorrect (3).');
}

unset($m['password']);

Api::response(200, $m);
