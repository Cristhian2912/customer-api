<?php

namespace App\Http\Controllers\CustomerManagement\Customers;

use Illuminate\Http\Request;
use Src\CustomerManagement\Customers\Application\Get\GetCustomersByCriteria;

class GetCustomersController
{
    private GetCustomersByCriteria $service;

    public function __construct(GetCustomersByCriteria $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $filters = json_decode($request->get('filters'), true) === null ? [] : json_decode($request->get('filters'), true);
        $response = $this->service->__invoke(
            $filters,
            $request->get('orderBy'),
            $request->get('orderType'),
            $request->get('perPage'),
            $request->get('page'),
        );
        return response()->json($response->getData()->toArray());
    }
}
