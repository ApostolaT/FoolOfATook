<?php

define('__ROOT__', dirname(__FILE__));

require_once __ROOT__."/vendor/autoload.php";

use \Model\Hobbit;

$hobbit = new Hobbit("Frodo", 0.3, 0.6, 0.5);

var_dump($hobbit);