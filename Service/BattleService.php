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

    public function battle(ArmiesCollection $armiesCollection): void
    {
        $armies['goodArmy'] = $armiesCollection->getGoodArmy();
        $armies['badArmy'] = $armiesCollection->getBadArmy();
        $minArmySize = min($armiesCollection->getGoodArmySize(), $armiesCollection->getBadArmySize());
        $maxArmySize = max($armiesCollection->getGoodArmySize(), $armiesCollection->getBadArmySize());
        $biggestArmyType = $this->getBiggestArmyName($armies['goodArmy'], $armies['badArmy']);
        $smallestArmyType = $this->getSmallestArmyName($armies['goodArmy'], $armies['badArmy']);

        for($i = 0; $i < $minArmySize; $i++) {
            $soldier1 = $armies[$smallestArmyType]->getIterator()[$i];
            $soldier2 = $armies[$biggestArmyType]
                ->getIterator()[
                    $this->randomNumberGenerator->generateRandomInt(0, $maxArmySize - 1)
            ];
        }
    }

    private function getBiggestArmyName(\Traversable $goodArmy, \Traversable  $badArmy): string
    {
        return ($goodArmy->getSize() > $badArmy->getSize()) ? 'goodArmy' : 'badArmy';
    }

    private function getSmallestArmyName(\Traversable $goodArmy, \Traversable  $badArmy): string
    {
        return ($goodArmy->getSize() < $badArmy->getSize()) ? 'goodArmy' : 'badArmy';
    }
}