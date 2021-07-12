<?php


namespace FoolOfATook\Model;


use FoolOfATook\Traits\SupernaturalSerializationTrait;


class Wizard extends ChildOfIluvatar
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

    protected function getFightPower(): float
    {
        return  20  * $this->strength +
                30  * $this->intelligence +
                5   * $this->charisma +
                20  * $this->supernatural;
    }

    use SupernaturalSerializationTrait;
}