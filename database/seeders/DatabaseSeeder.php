<?php

namespace Database\Seeders;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;
use Src\CustomerManagement\Customers\Domain\Customer;
use Src\CustomerManagement\Customers\Infrastructure\Persistence\Eloquent\EloquentCustomerModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        EloquentCustomerModel::factory()
            ->count(100)
            ->create();
    }
}
