<?php

namespace Model;

abstract class ChildOfIluvatar
{
    protected string  $name;
    protected float   $strength;
    protected float   $intelligence;
    protected float   $charisma;
    protected float   $fightPower;

    public function __construct(string $name, float $strength, float $intelligence, float $charisma)
    {
        // TODO: check for range, throw Exception;
        $this->name = $name;
        $this->strength = $strength;
        $this->intelligence = $intelligence;
        $this->charisma = $charisma;
    }

    abstract protected function setFightPower():void;
    abstract public function __serialize(): array;
    abstract public function __unserialize(array $data): void;
}