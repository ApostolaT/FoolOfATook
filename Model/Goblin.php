<?php


namespace FoolOfATook\Model;


use FoolOfATook\Traits\SupernaturalSerializationTrait;


class Goblin extends ChildOfIluvatar
{
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
    }

    public function getFightPower(): float
    {
        return  20  * $this->strength +
                10  * $this->intelligence +
                1   * $this->charisma +
                5   * $this->supernatural;
    }

    use SupernaturalSerializationTrait;
}