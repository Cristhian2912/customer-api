<?php

namespace Src\Shared\Domain\ValueObject;

abstract class StringVO
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->value;
    }
}
