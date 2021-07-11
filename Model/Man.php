<?php


namespace Model;


class Man extends ChildrenOfIluvatar
{
    private const STRENGTH = 30;
    private const INTELLIGENCE = 30;
    private const CHARISMA = 10;

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
        $this->fightPower =
            $this::STRENGTH * $this->strength +
            $this::INTELLIGENCE * $this->intelligence +
            $this::CHARISMA * $this->charisma;
    }
}