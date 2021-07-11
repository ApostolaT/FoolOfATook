<?php


namespace Model;


class Goblin extends ChildrenOfIluvatar
{
    private const STRENGTH = 20;
    private const INTELLIGENCE = 10;
    private const CHARISMA = 1;
    private const SUPERNATURAL = 5;

    private float $supernatural;

    public function __construct(
        string $name,
        float $strength,
        float $intelligence,
        float $charisma,
        float $supernatural
    ) {
        parent::__construct($name, $strength, $intelligence, $charisma);
        // TODO: check for range, throw Exception;
        $this->supernatural = $supernatural;
        $this->setFightPower();
    }

    protected function setFightPower(): void
    {
        $this->fightPower =
            $this::STRENGTH * $this->strength +
            $this::INTELLIGENCE * $this->intelligence +
            $this::CHARISMA * $this->charisma +
            $this::SUPERNATURAL * $this->supernatural;
    }
}