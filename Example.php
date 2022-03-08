<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$a = json_manage()->decode('{"www":"cas"}',false);
var_dump($a);


$b = json_manage()->encode($a);
var_dump($b);