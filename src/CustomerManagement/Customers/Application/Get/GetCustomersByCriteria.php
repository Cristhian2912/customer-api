<?php

namespace Src\CustomerManagement\Customers\Application\Get;

use Src\CustomerManagement\Customers\Domain\CustomerRepository;
use Src\Shared\Application\Response;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filters;
use Src\Shared\Domain\Criteria\Order;

class GetCustomersByCriteria
{
    private CustomerRepository $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(array $filters, ?string $orderBy, ?string $orderType, ?int $perPage, ?int $page): Response
    {
        $criteria = new Criteria(
            Filters::fromValues($filters),
            Order::fromValues($orderBy, $orderType),
            $perPage ?? 100,
            $page ?? 1
        );
        return new Response($this->repository->getByCriteria($criteria));
    }
}
