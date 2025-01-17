<?php 

class MasterConsole 
{
    public static function prompt($promt): string {
        $input = readline($promt . " ");
        return trim($input);
    }
}