<?php

define('__ROOT__', dirname(__FILE__));
require_once __ROOT__."/vendor/autoload.php";

use Model\Balrog;
use Model\ChildrenOfIluvatarCollection;
use Model\Dwarf;
use Model\Elf;
use Model\Goblin;
use Model\Hobbit;
use Model\Man;
use Model\Orc;
use Model\Trol;
use Model\Wizard;
use ProjectService\EntityCollectionSerializationService;
use ProjectService\FileWriterService;

$wizard = new Wizard("Frodo", 0.3, 0.6, 0.5, 0.9);
$balrog = new Balrog("Frodo", 0.3, 0.6, 0.5, 0.9);
$dwarf = new Dwarf("Frodo", 0.3, 0.6, 0.5);
$elf = new Elf("Frodo", 0.3, 0.6, 0.5, 0.9);
$goblin = new Goblin("Frodo", 0.3, 0.6, 0.5, 0.9);
$hobbit = new Hobbit("Frodo", 0.3, 0.6, 0.5);
$man = new Man("Frodo", 0.3, 0.6, 0.5);
$orc = new Orc("Frodo", 0.3, 0.6, 0.5, 0.9);
$trol = new Trol("Frodo", 0.3, 0.6, 0.5, 0.9);

$childrenOfIluvatar = new ChildrenOfIluvatarCollection();
$childrenOfIluvatar->add($wizard);
$childrenOfIluvatar->add($balrog);
$childrenOfIluvatar->add($dwarf);
$childrenOfIluvatar->add($elf);
$childrenOfIluvatar->add($hobbit);
$childrenOfIluvatar->add($man);
$childrenOfIluvatar->add($orc);
$childrenOfIluvatar->add($trol);

$entitySerializationService = new EntityCollectionSerializationService();

$fileWriteService = new FileWriterService($entitySerializationService);
$fileWriteService->writeToFile(__ROOT__."/Resources/file.txt", $childrenOfIluvatar);

