<?php

namespace Src\CustomerManagement\Customers\Domain\Services;

use Validator;
use Src\CustomerManagement\Customers\Application\Create\CreateCustomerCommand;
use Src\Shared\Domain\Validator\Validator as DomainValidator;

class CreateCustomerValidator extends DomainValidator
{
    public function validate(CreateCustomerCommand $command)
    {
        $validator = Validator::make([
            'firstName' => $command->getFirstName(),
            'lastName' => $command->getLastName(),
            'email' => $command->getEmail(),
            'phoneNumber' => $command->getPhoneNumber(),
        ], [
            'firstName' => ['required', 'max:50'],
            'lastName' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'phoneNumber' => ['required', 'max:15']
        ]);

        if($validator->fails()){
            $this->addErrors($validator->errors()->messages());
        }
    }
}
