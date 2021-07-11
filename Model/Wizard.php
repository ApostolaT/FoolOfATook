<?php


namespace Model;


use ProjectTrait\SupernaturalSerializationTrait;


class Wizard extends ChildOfIluvatar
{
    private const STRENGTH = 20;
    private const INTELLIGENCE = 30;
    private const CHARISMA = 5;
    private const SUPERNATURAL = 20;

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

    use SupernaturalSerializationTrait;
}