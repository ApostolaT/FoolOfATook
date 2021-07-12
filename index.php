<?php

define('__ROOT__', dirname(__FILE__));
require_once __ROOT__."/vendor/autoload.php";
include_once __ROOT__."/config.php";

use FoolOfATook\Model\Balrog;
use FoolOfATook\Model\ChildrenOfIluvatarCollection;
use FoolOfATook\Model\Dwarf;
use FoolOfATook\Model\Elf;
use FoolOfATook\Model\Goblin;
use FoolOfATook\Model\Hobbit;
use FoolOfATook\Model\Man;
use FoolOfATook\Model\Orc;
use FoolOfATook\Model\Trol;
use FoolOfATook\Model\Wizard;
use FoolOfATook\Service\ArmyParserService;
use FoolOfATook\Service\BattleService;
use FoolOfATook\Service\EntityCollectionSerializationService;
use FoolOfATook\Service\FileAccessWrapperService;
use FoolOfATook\Service\FileReaderService;
use FoolOfATook\Service\FileWriterService;
use FoolOfATook\Service\RandomNumberGenerator;

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
$fileAccessWrapperService = new FileAccessWrapperService();

$fileWriteService = new FileWriterService($entitySerializationService, $fileAccessWrapperService);
$fileWriteService->writeToFile(__ROOT__."/Resources/moria.txt", $childrenOfIluvatar);

$fileReaderService = new FileReaderService($entitySerializationService, $fileAccessWrapperService);
$readChildrenOfIluvatar = new ChildrenOfIluvatarCollection();
$readChildrenOfIluvatar = $fileReaderService->readFromFile(__ROOT__."/Resources/moria.txt", $readChildrenOfIluvatar);

$randomNumberGenerator = new RandomNumberGenerator();

if (isset($config)) {
    echo "Reading the characters that are allowed in the armies..." . PHP_EOL;
    $goodArmyConfig = $config['GOODARMY'];
    $badArmyConfig = $config['BADARMY'];
    $armyParserService = new ArmyParserService($goodArmyConfig, $badArmyConfig);
    $armyCollection = $armyParserService->parseChildrenOfIluvatar($readChildrenOfIluvatar);

    $battleService = new BattleService($randomNumberGenerator);
    $battleService->battle($armyCollection);
}
