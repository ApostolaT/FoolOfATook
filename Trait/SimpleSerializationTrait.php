<?php


namespace ProjectTrait;


/**
 * This trait is used ont he entities with no supernatural powers
 * Trait SimpleSerializationTrait
 * @package ProjectTrait
 */
trait SimpleSerializationTrait
{
    public function __serialize(): array
    {
        echo "Serializing "  . get_class($this) . PHP_EOL;
        return [
            'name'          => $this->name,
            'strength'      => $this->strength,
            'intelligence'  => $this->intelligence,
            'charisma'      => $this->charisma,
            'fightPower'    => $this->fightPower,
            'health'        => $this->health
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name         = $data['name'];
        $this->strength     = $data['strength'];
        $this->intelligence = $data['intelligence'];
        $this->charisma     = $data['charisma'];
        $this->fightPower   = $data['fightPower'];
        $this->health       = $data['health'];
    }
}