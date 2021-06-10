<?php

namespace Src\CustomerManagement\Customers\Application\Update;

class UpdateCustomerCommand
{
    private ?string $id;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $phoneNumber;

    function __construct(
        ?string $id,
        ?string $firstName,
        ?string $lastName,
        ?string $email,
        ?string $phoneNumber
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }
    
    public function getLastName(): ?string {
        return $this->lastName;
    }
    
    public function getEmail(): ?string {
        return $this->email;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }
}
