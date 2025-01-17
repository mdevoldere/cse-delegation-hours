<?php 
require_once '../../app/AccountManager.php';

AccountManager::loginMaster();

echo AccountManager::generatePassword('mdevoldere');