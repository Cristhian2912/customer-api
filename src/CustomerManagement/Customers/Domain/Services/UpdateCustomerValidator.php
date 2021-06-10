<?php

namespace Src\CustomerManagement\Customers\Domain\Services;

use Validator;
use Src\CustomerManagement\Customers\Application\Update\UpdateCustomerCommand;
use Src\CustomerManagement\Customers\Domain\Exceptions\CustomerNotExists;
use Src\Shared\Domain\Validator\Validator as DomainValidator;

class UpdateCustomerValidator extends DomainValidator
{
    public function validate(UpdateCustomerCommand $command)
    {
        $validator = Validator::make([
            'id' => $command->getId(),
            'firstName' => $command->getFirstName(),
            'lastName' => $command->getLastName(),
            'email' => $command->getEmail(),
            'phoneNumber' => $command->getPhoneNumber(),
        ], [
            'id' => ['required', 'exists:Src\CustomerManagement\Customers\Infrastructure\Persistence\Eloquent\EloquentCustomerModel,id'],
            'firstName' => ['required', 'max:50'],
            'lastName' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'phoneNumber' => ['required', 'max:9']
        ]);

        if($validator->fails()){
            if($validator->errors()->has('id')){
                throw new CustomerNotExists("The customer does not exists");
            }
            $this->addErrors($validator->errors()->messages());
        }
    }
}
