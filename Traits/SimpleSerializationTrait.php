<?php


namespace FoolOfATook\Traits;


/**
 * This trait is used ont he entities with no supernatural powers
 * Traits SimpleSerializationTrait
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
        $this->dead         = $data['dead'];
        $this->retreated    = $data['retreated'];
    }
}