<?php


namespace ProjectService;


use Contract\EntityCollectionSerializableInterface;
use Model\Balrog;
use Model\ChildrenOfIluvatarCollection;
use Model\Dwarf;
use Model\Elf;
use Model\Goblin;
use Model\Hobbit;
use Model\Man;
use Model\Orc;
use Model\Trol;
use Model\Wizard;
use Traversable;


class EntityCollectionSerializationService implements EntityCollectionSerializableInterface
{
    private const ALLOWEDCLASES = [
        Balrog::class,      Dwarf::class,       Elf::class,
        Goblin::class,      Hobbit::class,      Man::class,
        Orc::class,         Trol::class,        Wizard::class,
    ];

    public function serialize(Traversable $childrenOfIluvatar): array
    {
        $serializedCollection = [];
        foreach ($childrenOfIluvatar as $value) {
            $serializedCollection[] = serialize($value);
        }

        return $serializedCollection;
    }

    public function unserialize(array $childrenOfIluvatar): Traversable
    {
        $childrenOfIluvatarCollection = new ChildrenOfIluvatarCollection();

        foreach ($childrenOfIluvatar as $data) {
            $childrenOfIluvatarCollection->add(
                unserialize($data, ['allowed_classes' => $this::ALLOWEDCLASES])
            );
        }

        return $childrenOfIluvatarCollection;
    }
}