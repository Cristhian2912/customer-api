<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\CustomerManagement\Customers\Infrastructure\Persistence\Eloquent\EloquentCustomerModel;

class CustomerFactory extends Factory
{
/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentCustomerModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->name(),
            'lastName' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phoneNumber' => $this->faker->unique()->e164PhoneNumber()
        ];
    }
}
