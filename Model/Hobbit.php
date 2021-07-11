<?php

namespace Model;

class Hobbit extends ChildrenOfIluvatar
{
    public function __construct(
        string $name,
        float $strength,
        float $intelligence,
        float $charisma
    ) {
        parent::__construct($name, $strength, $intelligence, $charisma);
        // TODO: check for range, throw Exception;
        $this->setFightPower();
    }

    protected function setFightPower(): void
    {
        $this->fightPower = 10 * $this->strength + 20 * $this->intelligence + 20 * $this->charisma;
    }
}