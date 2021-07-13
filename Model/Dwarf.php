<?php


namespace FoolOfATook\Model;


use FoolOfATook\Traits\SimpleSerializationTrait;


class Dwarf extends ChildOfIluvatar
{
    public function __construct(
        string $name,
        float $strength,
        float $intelligence,
        float $charisma
    ) {
        parent::__construct($name, $strength, $intelligence, $charisma);
        // TODO: check for range, throw Exception;
    }

    public function getFightPower(): float
    {
        return  40 * $this->strength +
                10 * $this->intelligence +
                10 * $this->charisma;
    }

    use SimpleSerializationTrait;
}