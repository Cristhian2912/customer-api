<?php

namespace Src\Shared\Domain\Collection;

class Pagination
{
    private $collection;
    private int $perPage;
    private int $page;
    private int $totalResults;
    private int $totalItems;

    function __construct($collection, int $perPage, int $page, int $totalResults, int $totalItems)
    {
        $this->collection = $collection;
        $this->perPage = $perPage;
        $this->page = $page;
        $this->totalResults = $totalResults;
        $this->totalItems = $totalItems;
    }

    function getCollection() {
        return $this->collection;
    }

    function getPage(): int {
        return $this->page;
    }

    function getTotalItems(): int {
        return $this->totalItems;
    }

    function getTotalResults(): int {
        return $this->totalResults;
    }

    function getTotalOfPages(): int {
        $totalOfPages = ceil($this->totalResults / $this->perPage);
        return $totalOfPages == 0 ? 1 : $totalOfPages;
    }

    function getNextPage(): ?int {
        return $this->getPage() < $this->getTotalOfPages() ? $this->getPage()+1 : null;
    }

    function getPreviousPage(): ?int {
        return $this->getPage() > 1 ? $this->getPage()-1 : null;
    }

    function toArray(): array {
        return [
            'currentPage' => $this->getPage(),
            'data' => $this->getCollection()->toArray(),
            'previousPage' => $this->getPreviousPage(),
            'nextPage' => $this->getNextPage(),
            'totalPages' => $this->getTotalOfPages(),
            'totalResults' => $this->getTotalResults(),
            'totalItems' => $this->getTotalItems(),
        ];
    }
}
