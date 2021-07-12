<?php


namespace FoolOfATook\Model;


class ChildrenOfIluvatarCollection implements \IteratorAggregate
{
    private array $childrenOfiluvatar;

    public function __construct()
    {
        $this->childrenOfiluvatar = [];
    }

    public function add(ChildOfIluvatar $child)
    {
        $this->childrenOfiluvatar[] = $child;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->childrenOfiluvatar);
    }

    public function getSize(): int
    {
        return count($this->childrenOfiluvatar);
    }

    public function __serialize(): array
    {
        return ['childrenOfIluvatar' => $this->childrenOfiluvatar];
    }

    public function __unserialize(array $data): void
    {
        $this->childrenOfiluvatar = $data['childrenOfIluvatar'];
    }
}