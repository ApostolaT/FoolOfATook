<?php

define('__ROOT__', dirname(__FILE__));
require_once __ROOT__."/vendor/autoload.php";

use \Model\Hobbit;
use \Model\Elf;
use Model\Wizard;

$wizard = new Wizard("Frodo", 0.3, 0.6, 0.5, 0.9);

$serializedWizard = serialize($wizard);

echo sprintf("Serialized wizard: \n%s\n", $serializedWizard);

$desirializedWizard = unserialize($serializedWizard);

var_dump($desirializedWizard);
