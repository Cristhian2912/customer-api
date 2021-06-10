<?php
declare(strict_types=1);

namespace Src\Shared\Domain\Criteria;

final class Criteria
{
    private Filters $filters;
    private Order $order;
    private ?int $perPage;
    private ?int $page;

    public function __construct(
        Filters $filters,
        Order $order,
        ?int $perPage,
        ?int $page
    ) {
        $this->filters = $filters;
        $this->order = $order;
        $this->perPage = $perPage;
        $this->page = $page;
    }

    public function hasFilters(): bool
    {
        return $this->filters->count() > 0;
    }

    public function hasOrder(): bool
    {
        return !$this->order->isNone();
    }

    public function getFilters(): Filters
    {
        return $this->filters;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }
}