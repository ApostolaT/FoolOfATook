<?php


namespace ProjectTrait;


/**
 * This trait is used ont he entities with supernatural powers
 * Trait SupernaturalSerializationTrait
 * @package ProjectTrait
 */
trait SupernaturalSerializationTrait
{
    public function __serialize(): array
    {
        return [
            'name'          => $this->name,
            'strength'      => $this->strength,
            'intelligence'  => $this->intelligence,
            'charisma'      => $this->charisma,
            'supernatural'  => $this->supernatural,
            'fightPower'    => $this->fightPower
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name         = $data['name'];
        $this->strength     = $data['strength'];
        $this->intelligence = $data['intelligence'];
        $this->charisma     = $data['charisma'];
        $this->supernatural = $data['supernatural'];
        $this->fightPower   = $data['fightPower'];
    }
}