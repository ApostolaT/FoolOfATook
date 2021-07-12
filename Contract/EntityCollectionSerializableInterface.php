<?php


namespace Contract;


interface EntityCollectionSerializableInterface
{
    public function serialize(\Traversable $childrenOfIluvatar): array;
    public function unserialize(array $childrenOfIluvatar): \Traversable;
    public function unserializeOne(string $data, \Traversable $childrenOffIluvatar): \Traversable;
}