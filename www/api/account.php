<?php 

require_once '../../app/Api.php';

if(empty($_GET['username'])) {
    exit(APi::toJsonError('Empty Username'));
}

if(!is_file(__DIR__ . ''))