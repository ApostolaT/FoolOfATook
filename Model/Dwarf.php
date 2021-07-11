<?php


namespace Model;


use ProjectTrait\SimpleSerializationTrait;


class Dwarf extends ChildOfIluvatar
{
    private const STRENGTH = 40;
    private const INTELLIGENCE = 10;
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

    use SimpleSerializationTrait;
}