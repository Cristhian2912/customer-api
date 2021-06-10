<?php

namespace Src\CustomerManagement\Customers\Infrastructure\Persistence\Eloquent;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentCustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected static function newFactory()
    {
        return CustomerFactory::new();
    }
}
