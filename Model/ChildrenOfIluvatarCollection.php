<?php


namespace Model;


use Exception;
use Traversable;

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

    /**
     * @return array
     */
    public function getChildrenOfIluvatar(): array
    {
        return $this->childrenOfiluvatar;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->childrenOfiluvatar);
    }
}