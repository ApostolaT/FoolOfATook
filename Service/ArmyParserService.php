<?php


namespace ProjectService;


use Model\ArmyCollection;
use Model\Balrog;
use ProjectException\NoSuchChildInConfig;

class ArmyParserService
{
    private array $goodArmyConfig;
    private array $badArmyConfig;

    public function __construct(array $goodArmyConfig, array $badArmyConfig)
    {
        $this->goodArmyConfig   = $goodArmyConfig;
        $this->badArmyConfig    = $badArmyConfig;
    }

    public function parseChildrenOfIluvatar(\Traversable $childrenOfIluvatarCollection): ArmyCollection
    {
        $armyCollection = new ArmyCollection();
        try {
            echo 'Initializing the Armies...' . PHP_EOL;
            echo 'Extracting entities:' . PHP_EOL;
            foreach ($childrenOfIluvatarCollection as $value) {
                if (get_class($value) === Balrog::class) {
                    echo 'The good army encountered a Balrog, but they are not ready to battle him yet' . PHP_EOL;
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