<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Core\Repositories\CustomerRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\CustomerRequest;
use App\Http\Resources\UserResources\CustomerResource;

class CustomerController extends Controller
{
    private $customerRepo ;
    public function __construct(CustomerRepo $customerRepo )
    {
        $this->customerRepo = $customerRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Customers = $this->customerRepo->getCustomers();
        return CustomerResource::collection($Customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $customer = $this->customerRepo->getCustomerByID($id);
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, User $customer)
    {
        $action = $this->customerRepo->updateCustomer($request , $customer);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Customer' => $customer,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
