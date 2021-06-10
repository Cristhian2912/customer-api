<?php

namespace Src\CustomerManagement\Customers\Infrastructure\Persistence\Eloquent;

use Src\CustomerManagement\Customers\Domain\Customer;
use Src\CustomerManagement\Customers\Domain\CustomerCollection;
use Src\CustomerManagement\Customers\Domain\CustomerRepository;
use Src\Shared\Domain\Criteria\Criteria;
use DB;
use Src\Shared\Domain\Collection\Pagination;
use Src\Shared\Domain\Criteria\FilterOperator;

class EloquentCustomerRepository implements CustomerRepository
{
    public function create(Customer $customer): int
    {
        $model = new EloquentCustomerModel();
        $model->firstName = $customer->getFirstName();
        $model->lastName = $customer->getLastName();
        $model->email = $customer->getEmail();
        $model->phoneNumber = $customer->getPhoneNumber();
        $model->save();
        return $model->id;
    }

    public function update(Customer $customer): void
    {
        $model = EloquentCustomerModel::find($customer->getId());
        $model->firstName = $customer->getFirstName();
        $model->lastName = $customer->getLastName();
        $model->email = $customer->getEmail();
        $model->phoneNumber = $customer->getPhoneNumber();
        $model->save();
    }

    public function findById(string $id): ?Customer
    {
        $model = EloquentCustomerModel::find($id);
        if($model !== null){
            return new Customer(
                $model->id,
                $model->firstName,
                $model->lastName,
                $model->email,
                $model->phoneNumber,
            );
        }
        return null;
    }

    public function getByCriteria(Criteria $criteria): Pagination
    {
        $filters = $criteria->getFilters()->items();
        $queryBuilder = EloquentCustomerModel::query();
        foreach($filters as $filter){
            if($filter->getField()->getValue() == 'any' && $filter->getOperator()->getValue() == FilterOperator::CONTAINS){
                $queryBuilder = EloquentCustomerModel::where(
                    DB::Raw("concat(id, ' ', firstName, ' ', lastName, ' ', email, ' ', phoneNumber)"),
                    "like",
                    '%'.$filter->getValue()->getValue().'%'
                );
            }
        }

        $queryBuilder->orderBy($criteria->getOrder()->orderBy()->getValue(), $criteria->getOrder()->orderType()->getValue());
        $totalOfItems = $queryBuilder->count();
        $resp = $queryBuilder->paginate($criteria->getPerPage(), ['*'], 'page', $criteria->getPage());
        
        $collection = new CustomerCollection();
        foreach($resp as $item){
            $collection->add(new Customer(
                $item->id,
                $item->firstName,
                $item->lastName,
                $item->email,
                $item->phoneNumber,
            ));
        }

        $pagination = new Pagination(
            $collection,
            $criteria->getPerPage(),
            $criteria->getPage(),
            $totalOfItems,
            EloquentCustomerModel::count()
        );
        return $pagination;
    }
}
