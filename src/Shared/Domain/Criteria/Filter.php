<?php
declare(strict_types=1);

namespace Src\Shared\Domain\Criteria;

final class Filter
{
    private FilterField $field;
    private FilterOperator $operator;
    private FilterValue $value;

    public function __construct(
        FilterField $field,
        FilterOperator $operator,
        FilterValue $value
    ) {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    public static function fromValues(array $values): self
    {
        return new self(
            new FilterField($values['field']),
            new FilterOperator($values['operator']),
            new FilterValue($values['value'])
        );
    }

    public function getField(): FilterField
    {
        return $this->field;
    }

    public function getOperator(): FilterOperator
    {
        return $this->operator;
    }

    public function getValue(): FilterValue
    {
        return $this->value;
    }
}
