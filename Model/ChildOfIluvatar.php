<?php


namespace FoolOfATook\Model;


abstract class ChildOfIluvatar
{
    protected string    $name;
    protected float     $strength;
    protected float     $intelligence;
    protected float     $charisma;
    protected bool      $dead;
    protected bool      $retreated;

    public function __construct(string $name, float $strength, float $intelligence, float $charisma)
    {
        // TODO: check for range, throw Exception;
        $this->name         = $name;
        $this->strength     = $strength;
        $this->intelligence = $intelligence;
        $this->charisma     = $charisma;
        $this->dead         = false;
        $this->retreated    = false;
    }

    abstract public function getFightPower(): float;
    abstract public function __serialize(): array;
    abstract public function __unserialize(array $data): void;

    public function isDead(): bool
    {
        return $this->dead;
    }

    public function isRetreated(): bool
    {
        return $this->retreated;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param bool $dead
     */
    public function setDead(bool $dead): void
    {
        $this->dead = $dead;
    }

    /**
     * @param bool $retreated
     */
    public function setRetreated(bool $retreated): void
    {
        $this->retreated = $retreated;
    }


}