<?php


namespace FoolOfATook\Contract;


interface EntityCollectionSerializableInterface
{
    public function serialize(\Traversable $childrenOfIluvatar): string;
    public function unserialize(string $childrenOfIluvatar): \Traversable;
    public function unserializeOne(string $data, \Traversable $childrenOffIluvatar): \Traversable;
}