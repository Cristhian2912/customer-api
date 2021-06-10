<?php

namespace App\Http\Controllers\CustomerManagement\Customers;

use Illuminate\Http\Request;
use Src\CustomerManagement\Customers\Application\Update\UpdateCustomer;
use Src\CustomerManagement\Customers\Application\Update\UpdateCustomerCommand;

class UpdateCustomerController
{
    private UpdateCustomer $service;

    public function __construct(UpdateCustomer $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, $id)
    {
        try {
            $command = new UpdateCustomerCommand(
                $id,
                $request->input('firstName'),
                $request->input('lastName'),
                $request->input('email'),
                $request->input('phoneNumber')
            );
            $resp = $this->service->__invoke($command);
            if($resp->passes()){
                return response()->json([
                    'passes' => $resp->passes(),
                    'errors' => $resp->getErrors()
                ]);
            }
            return response()->json([
                'passes' => $resp->passes(),
                'errors' => $resp->getErrors()
            ]);
        } catch (\Src\CustomerManagement\Customers\Domain\Exceptions\CustomerNotExists $e) {
            return response()->json([], 404);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 500);
        }
    }
}
