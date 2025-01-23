<?php 

require_once '../../app/Api.php';

$t = require_once '../../data/members.php';

foreach($t as $k => $m) {
    unset($t[$k]['password']);
}

Api::response(200, $t);
