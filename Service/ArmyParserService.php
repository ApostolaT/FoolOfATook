<?php


namespace FoolOfATook\Service;


use FoolOfATook\Model\ArmiesCollection;
use FoolOfATook\Model\Balrog;
use FoolOfATook\Exception\NoSuchChildInConfig;

class ArmyParserService
{
    private array                   $goodArmyConfig;
    private array                   $badArmyConfig;
    private RandomNumberGenerator   $randomNumberGenerator;
    private bool                    $firstBattle;

    public function __construct(
        array $goodArmyConfig,
        array $badArmyConfig,
        RandomNumberGenerator $randomNumberGenerator
    ) {
        $this->goodArmyConfig        = $goodArmyConfig;
        $this->badArmyConfig         = $badArmyConfig;
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->firstBattle           = true;
    }

    public function parseChildrenOfIluvatar(\Traversable $childrenOfIluvatarCollection): ArmiesCollection
    {
        $armyCollection = new ArmiesCollection();
        try {
            echo 'Initializing the Armies...' . PHP_EOL;
            echo 'Extracting entities:' . PHP_EOL;
            foreach ($childrenOfIluvatarCollection as $value) {
                echo '-->';
                if ($value->isDead() === true) {
                    $this->firstBattle = false;
                    echo get_class($value) . ' is dead, he is no longer able to fight' . PHP_EOL;
                    continue;
                }

                if (get_class($value) === Balrog::class && $this->firstBattle === true) {
                    echo 'The good army encountered a Balrog, but they are not ready to battle him yet' . PHP_EOL;
                    continue;
                }

                if (get_class($value) === Balrog::class && $this->firstBattle === false) {
                    if ($this->randomNumberGenerator->generateRandomInt(1, 100) < 52) {
                        echo "Balrog still watches the battle from the far"  . PHP_EOL;
                        continue;
                    }
                    echo 'A Balrog, decided to enter a battle' . PHP_EOL;
                    $armyCollection->addToBadArmy($value);
                    continue;
                }

                if (in_array(get_class($value), $this->goodArmyConfig)) {
                    echo 'Adding ' . get_class($value) . ' to the Good Army' . PHP_EOL;
                    $armyCollection->addToGoodArmy($value);
                    continue;
                }

                if (in_array(get_class($value), $this->badArmyConfig)) {
                    echo 'Adding ' . get_class($value) . ' to the Evil Army' . PHP_EOL;
                    $armyCollection->addToBadArmy($value);
                    continue;
                }
                echo "---Exception happened---" . PHP_EOL;
                throw new NoSuchChildInConfig(
                    'Child ' . get_class($value) .
                    ' is not allowed or is missing from the config file!'
                    . PHP_EOL
                );
            }
        } catch (NoSuchChildInConfig $exception) {
            echo $exception->getMessage();
            exit("Armies could not be parsed completely" . PHP_EOL . 'Terminating the app.' . PHP_EOL);
        }
        echo "Army parsing ended successfully! The two armies are preparing for the battle" . PHP_EOL;
        return $armyCollection;
    }
}