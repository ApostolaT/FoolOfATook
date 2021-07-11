<?php


namespace Model;


use ProjectTrait\SimpleSerializationTrait;


class Hobbit extends ChildrenOfIluvatar
{
    private const STRENGTH = 10;
    private const INTELLIGENCE = 20;
    private const CHARISMA = 20;

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
            $this->intelligence * $this->intelligence +
            $this::CHARISMA * $this->charisma;
    }

    use SimpleSerializationTrait;
}