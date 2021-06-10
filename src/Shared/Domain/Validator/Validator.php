<?php

namespace Src\Shared\Domain\Validator;

abstract class Validator
{
    private array $errors = [];

    function getErrors(): array {
        return $this->errors;
    }

    function addErrors($errors): void {
        foreach ($errors as $key => $err){
            $this->errors[$key] = $err;
        }
    }

    function setErrors($errors): void {
        $this->errors = $errors;
    }

    function passes(): bool {
        return count($this->errors) == 0 ? true : false;
    }

    function fails(): bool {
        return !$this->passes();
    }
}
