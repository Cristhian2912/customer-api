<?php

namespace Src\Shared\Domain\Criteria;

use Src\Shared\Domain\ValueObject\StringVO;
use InvalidArgumentException;

final class OrderType extends StringVO
{
    public const ASC  = 'asc';
    public const DESC = 'desc';
    public const NONE = 'none';

    function __construct($value)
    {
        if($value != self::ASC && $value != self::DESC && $value != self::NONE){
            $this->throwExceptionForInvalidValue($value);
        }
        $this->value = $value;
    }
    
    public static function asc(): OrderType {
        return new self(self::ASC);
    }

    public static function desc(): OrderType {
        return new self(self::DESC);
    }

    public static function none(): OrderType {
        return new self(self::NONE);
    }

    public function isNone(): bool
    {
        return $this->getValue() === self::NONE;
    }

    private function throwExceptionForInvalidValue($value): void
    {
        throw new InvalidArgumentException("The order type '{$value}' is not valid");
    }
}
