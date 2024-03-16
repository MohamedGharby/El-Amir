<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Core\Repositories\AdminRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\AdminRequest;
use App\Http\Resources\UserResources\AdminResource;

class AdminController extends Controller
{
    private $adminRepo ;
    public function __construct(AdminRepo $adminRepo )
    {
        $this->adminRepo = $adminRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Admins = $this->adminRepo->getAdmins();
        return AdminResource::collection($Admins);
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
        $Admin = $this->adminRepo->getAdminByID($id);
        return AdminResource::make($Admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, User $Admin)
    {
        $action = $this->adminRepo->updateAdmin($request , $Admin);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Admin' => $Admin,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $Admin)
    {
        $action = $this->adminRepo->deleteAdmin($Admin);
        if ($action) {
            return response()->json([
                'Message' => 'تم الحذف بنجاح',
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }
    
}
