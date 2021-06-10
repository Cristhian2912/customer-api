<?php

namespace Src\Shared\Domain\Collection;

abstract class Collection
{
    private array $collection = [];

    function getCollection(): array{
        return $this->collection;
    }

    public function add($item): void
    {
        $this->collection[] = $item;
    }

    function get($index){
        return $this->collection[$index];
    }

    function count(){
        return count($this->collection);
    }

    function getFirts(){
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    function toArray(): array
    {
        $arrayCollection = [];
        foreach($this->getCollection() as $row){
            $arrayCollection[] = $row->toArray();
        }
        return $arrayCollection;
    }
}
