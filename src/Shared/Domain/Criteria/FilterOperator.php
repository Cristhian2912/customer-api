<?php

namespace Src\Shared\Domain\Criteria;

use Src\Shared\Domain\ValueObject\StringVO;
use InvalidArgumentException;

class FilterOperator extends StringVO
{
    public const EQUAL        = '=';
    public const NOT_EQUAL    = '!=';
    public const GT           = '>';
    public const LT           = '<';
    public const CONTAINS     = 'CONTAINS';
    public const NOT_CONTAINS = 'NOT_CONTAINS';

    public function __construct(string $value)
    {
        parent::__construct($value);
        if($this->isInvalid()){
            $this->throwExceptionForInvalidValue($value);
        }
    }

    private function isInvalid(): bool {
        return !in_array($this->getValue(), [self::EQUAL, self::NOT_EQUAL, self::GT, self::LT, self::CONTAINS, self::NOT_CONTAINS], true);
    }

    private function throwExceptionForInvalidValue($value): void
    {
        throw new InvalidArgumentException(sprintf('The operator <%s> is invalid', $value));
    }
}
