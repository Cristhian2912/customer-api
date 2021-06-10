<?php

namespace Src\Shared\Application;

class Response
{
    private $data;
    private array $errors;

    public function __construct($data = null, array $errors = []) {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function passes(): bool {
        return count($this->errors) == 0 ? true : false;
    }

    public function fails(): bool {
        return !$this->passes();
    }

    public function getData() {
        return $this->data;
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
