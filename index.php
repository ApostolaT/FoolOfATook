<?php

define('__ROOT__', dirname(__FILE__));
require_once __ROOT__."/vendor/autoload.php";

use \Model\Hobbit;
use \Model\Elf;

$hobbit = new Hobbit("Frodo", 0.3, 0.6, 0.5);
$elf = new Elf("Elf", 0.9, 0.9, 0.7, 0.6);

var_dump($elf);
