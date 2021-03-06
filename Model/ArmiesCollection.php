<?php


namespace FoolOfATook\Model;


class ArmiesCollection
{
    private ChildrenOfIluvatarCollection $goodArmy;
    private ChildrenOfIluvatarCollection $badArmy;

    public function __construct()
    {
        $this->badArmy = new ChildrenOfIluvatarCollection();
        $this->goodArmy = new ChildrenOfIluvatarCollection();
    }

    public function addToGoodArmy(ChildOfIluvatar $childOfIluvatar): void
    {
        $this->goodArmy->add($childOfIluvatar);
    }

    public function addToBadArmy(ChildOfIluvatar $childOfIluvatar): void
    {
        $this->badArmy->add($childOfIluvatar);
    }

    public function getGoodArmy(): \Traversable
    {
        return $this->goodArmy;
    }

    public function getBadArmy(): \Traversable
    {
        return $this->badArmy;
    }

    public function getGoodArmySize(): int
    {
        return $this->goodArmy->getSize();
    }

    public function getBadArmySize(): int
    {
        return $this->badArmy->getSize();
    }
}