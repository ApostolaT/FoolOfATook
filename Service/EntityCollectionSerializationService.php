<?php


namespace FoolOfATook\Service;


use FoolOfATook\Contract\EntityCollectionSerializableInterface;
use FoolOfATook\Model\Balrog;
use FoolOfATook\Model\Dwarf;
use FoolOfATook\Model\Elf;
use FoolOfATook\Model\Goblin;
use FoolOfATook\Model\Hobbit;
use FoolOfATook\Model\Man;
use FoolOfATook\Model\Orc;
use FoolOfATook\Model\Trol;
use FoolOfATook\Model\Wizard;
use Traversable;


class EntityCollectionSerializationService implements EntityCollectionSerializableInterface
{
    private const ALLOWEDCLASES = [
        Balrog::class,      Dwarf::class,       Elf::class,
        Goblin::class,      Hobbit::class,      Man::class,
        Orc::class,         Trol::class,        Wizard::class,
    ];

    public function serialize(Traversable $childrenOfIluvatar): string
    {
        return serialize($childrenOfIluvatar);
    }

    public function unserialize(string $childrenOfIluvatar): Traversable
    {
        return unserialize($childrenOfIluvatar);
    }

    public function unserializeOne(string $data, \Traversable $childrenOffIluvatar): Traversable
    {
        $childrenOffIluvatar->add(
            unserialize($data, ['allowed_classes' => $this::ALLOWEDCLASES])
        );

        return $childrenOffIluvatar;
    }
}