<?php

define('__ROOT__', dirname(__FILE__));
require_once __ROOT__."/vendor/autoload.php";
include_once __ROOT__."/config.php";

use FoolOfATook\Exception\NotEnoughCharactersException;
use FoolOfATook\Model\ChildrenOfIluvatarCollection;
use FoolOfATook\Service\ArmyParserService;
use FoolOfATook\Service\BattleService;
use FoolOfATook\Service\EntityCollectionSerializationService;
use FoolOfATook\Service\FileAccessWrapperService;
use FoolOfATook\Service\FileReaderService;
use FoolOfATook\Service\FileWriterService;
use FoolOfATook\Service\RandomEntityCollectionGenerator;
use FoolOfATook\Service\RandomNumberGenerator;

echo "====================" . PHP_EOL;
echo "= Program Starting =" . PHP_EOL;
echo "====================" . PHP_EOL . PHP_EOL;

$randomNumberGenerator = new RandomNumberGenerator();
$randomEntityCollectionGenerator = new RandomEntityCollectionGenerator($randomNumberGenerator);

try {
    $childrenOfIluvatar = $randomEntityCollectionGenerator->createCharacters(10);
} catch (NotEnoughCharactersException $exception) {
    echo "===Exception happened===" . PHP_EOL;
    echo $exception->getMessage();
    exit();
}

$entitySerializationService = new EntityCollectionSerializationService();
$fileAccessWrapperService = new FileAccessWrapperService();

$fileWriteService = new FileWriterService($entitySerializationService, $fileAccessWrapperService);

echo PHP_EOL . "====================" . PHP_EOL;
echo           "= SAVING  ENTITIES =" . PHP_EOL;
echo           "====================" . PHP_EOL . PHP_EOL;
$fileWriteService->writeToFile(__ROOT__."/Resources/moria.txt", $childrenOfIluvatar);

$fileReaderService = new FileReaderService($entitySerializationService, $fileAccessWrapperService);
$readChildrenOfIluvatar = new ChildrenOfIluvatarCollection();

$battleService = new BattleService($randomNumberGenerator);

if (isset($config)) {
    echo "Reading the characters that are allowed in the armies..." . PHP_EOL;
    $goodArmyConfig = $config['GOODARMY'];
    $badArmyConfig = $config['BADARMY'];
    $armyParserService = new ArmyParserService($goodArmyConfig, $badArmyConfig, $randomNumberGenerator);
    $battleIsOver = false;
    $battleCounter = 1;
    echo PHP_EOL . "====================" . PHP_EOL;
    echo           "= PREPING FOR WAR  =" . PHP_EOL;
    echo           "====================" . PHP_EOL . PHP_EOL;
    do {
        echo PHP_EOL . "============" . PHP_EOL;
        echo           "= Battle $battleCounter =" . PHP_EOL;
        echo           "============" . PHP_EOL . PHP_EOL;
        $readChildrenOfIluvatar = $fileReaderService->readFromFile(__ROOT__ . "/Resources/moria.txt", $readChildrenOfIluvatar);
        $armyCollection = $armyParserService->parseChildrenOfIluvatar($readChildrenOfIluvatar);

        $battleIsOver = $battleService->battle($armyCollection);
        if ($battleIsOver === false) {
            echo "--- Saving battle results to the moria archives ---" . PHP_EOL;
            $fileWriteService->writeToFile(__ROOT__ . "/Resources/moria.txt", $readChildrenOfIluvatar);
        }
        echo PHP_EOL . "===============" . PHP_EOL;
        echo           "= BATTLE OVER =" . PHP_EOL;
        echo           "===============" . PHP_EOL . PHP_EOL;

        ++$battleCounter;
    } while ($battleIsOver === false);
    echo "===THE WAR IS OVER===" . PHP_EOL;
    $winner = ($armyCollection->getGoodArmySize() === 0) ? 'Bad Army' : 'Good Army';
    echo "THE WINNER IS " . $winner . PHP_EOL;
}