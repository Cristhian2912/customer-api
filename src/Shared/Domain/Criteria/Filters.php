<?php

namespace Src\Shared\Domain\Criteria;

final class Filters
{
    private $items = [];

    function __construct($items)
    {
        $this->items = $items;
    }

    public function items(): array {
        return $this->items;
    }

    public function count(): int {
        return count($this->items);
    }

    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    private static function filterBuilder(): callable
    {
        return fn(array $values) => Filter::fromValues($values);
    }

    public function add(Filter $filter): self
    {
        return new self(array_merge($this->items(), [$filter]));
    }

}
