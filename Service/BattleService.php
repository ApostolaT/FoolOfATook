<?php


namespace FoolOfATook\Service;


use FoolOfATook\Model\ArmiesCollection;


class BattleService
{
    private RandomNumberGenerator $randomNumberGenerator;

    public function __construct(RandomNumberGenerator $randomNumberGenerator)
    {
        $this->randomNumberGenerator = $randomNumberGenerator;
    }

    public function battle(ArmiesCollection $armiesCollection): bool
    {
        $armies['goodArmy'] = $armiesCollection->getGoodArmy();
        $armies['badArmy'] = $armiesCollection->getBadArmy();
        $minArmySize = min($armiesCollection->getGoodArmySize(), $armiesCollection->getBadArmySize());
        if ($minArmySize === 0) {
            echo "---One army cannot fight anymore---" . PHP_EOL;
            return true; // there are no more soldiers in one of the army, battles are over
        }
        $maxArmySize = max($armiesCollection->getGoodArmySize(), $armiesCollection->getBadArmySize());
        $biggestArmyType = $this->getBiggestArmyName($armies['goodArmy'], $armies['badArmy']);
        $smallestArmyType = $this->getSmallestArmyName($armies['goodArmy'], $armies['badArmy']);
        $visitedIndexes = [];
        for($i = 0; $i < $minArmySize; $i++) {
            $soldier1 = $armies[$smallestArmyType]->getIterator()[$i];
            echo '-->' . $soldier1->getName() . ' who is an ' . get_class($soldier1) . ' is batteling ';
            $randomIndex = $this->getRandomNumber($maxArmySize);
            while(isset($visitedIndexes[$randomIndex]) === true) {
                $randomIndex = $this->getRandomNumber($maxArmySize);
            }
            $visitedIndexes[$randomIndex] = 1;
            $soldier2 = $armies[$biggestArmyType]->getIterator()[$randomIndex];
            echo $soldier2->getName() . ' who is an ' . get_class($soldier2) . PHP_EOL;
            $chanceOfSurvival = $this->randomNumberGenerator->generateRandomInt(1, 100);
            $losingSoldier = ($soldier1->getFightPower() > $soldier2->getFightPower()) ? $soldier2 : $soldier1;
            echo '-->' . $losingSoldier->getName() . ' the ' . get_class($losingSoldier) . ' lost the fight and is ';
            if ($chanceOfSurvival > 80) {
                echo 'retreating' . PHP_EOL;
                $losingSoldier->setRetreated(true);
                continue;
            }
            echo 'dead' . PHP_EOL;
            $losingSoldier->setDead(true);
        }

        return false;
    }

    private function getBiggestArmyName(\Traversable $goodArmy, \Traversable  $badArmy): string
    {
        return ($goodArmy->getSize() > $badArmy->getSize()) ? 'goodArmy' : 'badArmy';
    }

    private function getSmallestArmyName(\Traversable $goodArmy, \Traversable  $badArmy): string
    {
        return ($goodArmy->getSize() < $badArmy->getSize()) ? 'goodArmy' : 'badArmy';
    }

    private function getRandomNumber(int $max): int
    {
        if (1 === $max) {
            return 0;
        }

        return $this->randomNumberGenerator->generateRandomInt(1, $max) - 1;
    }
}