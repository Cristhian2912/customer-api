<?php

namespace Src\CustomerManagement\Customers\Application\Create;

use Src\CustomerManagement\Customers\Domain\Customer;
use Src\CustomerManagement\Customers\Domain\CustomerRepository;
use Src\CustomerManagement\Customers\Domain\Services\CreateCustomerValidator;
use Src\Shared\Application\Response;

class CreateCustomer
{
    private CustomerRepository $repository;
    private CreateCustomerValidator $validator;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
        $this->validator = new CreateCustomerValidator();
    }

    public function __invoke(CreateCustomerCommand $command): Response
    {
        $this->validator->validate($command);
        if($this->validator->passes()){
            $customer = Customer::create(
                $command->getFirstName(),
                $command->getLastName(),
                $command->getEmail(),
                $command->getPhoneNumber()
            );
            
            $customerId = $this->repository->create($customer);

            return new Response(
                $this->repository->findById($customerId),
                $this->validator->getErrors()
            );
        }
        return new Response(null, $this->validator->getErrors());
    }
}
