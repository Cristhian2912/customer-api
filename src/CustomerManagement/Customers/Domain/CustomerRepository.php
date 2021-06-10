<?php

namespace Src\CustomerManagement\Customers\Domain;

use Src\Shared\Domain\Collection\Pagination;
use Src\Shared\Domain\Criteria\Criteria;

interface CustomerRepository
{
    public function create(Customer $customer): int;
    public function update(Customer $customer): void;
    public function findById(string $id): ?Customer;
    public function getByCriteria(Criteria $criteria): Pagination;
}
