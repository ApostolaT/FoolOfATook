<?php


namespace FoolOfATook\Traits;


/**
 * This trait is used ont he entities with supernatural powers
 * Traits SupernaturalSerializationTrait
 * @package ProjectTrait
 */
trait SupernaturalSerializationTrait
{
    public function __serialize(): array
    {
        echo "Serializing "  . get_class($this) . PHP_EOL;
        return [
            'name'          => $this->name,
            'strength'      => $this->strength,
            'intelligence'  => $this->intelligence,
            'charisma'      => $this->charisma,
            'supernatural'  => $this->supernatural,
            'dead'          => $this->dead,
            'retreated'     => $this->retreated
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name         = $data['name'];
        $this->strength     = $data['strength'];
        $this->intelligence = $data['intelligence'];
        $this->charisma     = $data['charisma'];
        $this->supernatural = $data['supernatural'];
        $this->dead         = $data['dead'];
        $this->retreated    = $data['retreated'];
    }
}