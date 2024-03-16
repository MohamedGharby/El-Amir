<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Core\Repositories\MerchantRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\MerchantRequest;
use App\Http\Resources\UserResources\MerchantResource;

class MerchantController extends Controller
{
    private $merchantRepo ;
    public function __construct(MerchantRepo $merchantRepo )
    {
        $this->merchantRepo = $merchantRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchant = $this->merchantRepo->getMerchants();
        return MerchantResource::collection($merchant);
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
    public function show($id)
    {
        $merchant = $this->merchantRepo->getMerchantByID($id);
        return MerchantResource::make($merchant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MerchantRequest $request, User $merchant)
    {
        $action = $this->merchantRepo->updateMerchant($request , $merchant);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Merchant' => $merchant,
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
