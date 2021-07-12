<?php


namespace FoolOfATook\Model;


use FoolOfATook\Traits\SimpleSerializationTrait;


class Man extends ChildOfIluvatar
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

    protected function getFightPower(): float
    {
        return
            30 * $this->strength +
            30 * $this->intelligence +
            10 * $this->charisma;
    }

    use SimpleSerializationTrait;
}