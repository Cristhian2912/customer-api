<?php

namespace App\Http\Controllers\CustomerManagement\Customers;

use Illuminate\Http\Request;
use Src\CustomerManagement\Customers\Application\Create\CreateCustomer;
use Src\CustomerManagement\Customers\Application\Create\CreateCustomerCommand;

class CreateCustomerController
{
    private CreateCustomer $service;

    public function __construct(CreateCustomer $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        try {
            $command = new CreateCustomerCommand(
                $request->input('firstName'),
                $request->input('lastName'),
                $request->input('email'),
                $request->input('phoneNumber')
            );
            $resp = $this->service->__invoke($command);
            if($resp->passes()){
                return response()->json([
                    'passes' => $resp->passes(),
                    'errors' => $resp->getErrors(),
                    'data' => $resp->getData()->toArray()
                ], 201);
            }
            return response()->json([
                'passes' => $resp->passes(),
                'errors' => $resp->getErrors()
            ]);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 500);
        }
    }
}
