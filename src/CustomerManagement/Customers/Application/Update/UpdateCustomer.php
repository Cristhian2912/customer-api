<?php

namespace Src\CustomerManagement\Customers\Application\Update;

use Src\CustomerManagement\Customers\Domain\CustomerRepository;
use Src\CustomerManagement\Customers\Domain\Services\UpdateCustomerValidator;
use Src\Shared\Application\Response;

class UpdateCustomer
{
    private CustomerRepository $repository;
    private UpdateCustomerValidator $validator;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
        $this->validator = new UpdateCustomerValidator();
    }

    public function __invoke(UpdateCustomerCommand $command): Response
    {
        $this->validator->validate($command);
        if($this->validator->passes()){
            $customer = $this->repository->findById($command->getId());
            $customer->update(
                $command->getFirstName(),
                $command->getLastName(),
                $command->getEmail(),
                $command->getPhoneNumber()
            );
            $this->repository->update($customer);
        }
        return new Response(null, $this->validator->getErrors());
    }
}
