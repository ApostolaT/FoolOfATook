<?php


namespace FoolOfATook\Model;


use FoolOfATook\Traits\SimpleSerializationTrait;


class Hobbit extends ChildOfIluvatar
{
    public function __construct(
        string $name,
        float $strength,
        float $intelligence,
        float $charisma
    ){
        parent::__construct($name, $strength, $intelligence, $charisma);
        // TODO: check for range, throw Exception;
    }

    protected function getFightPower(): float
    {
        return  10 * $this->strength +
                20 * $this->intelligence +
                20 * $this->charisma;
    }

    use SimpleSerializationTrait;
}