<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Repositories\NotificationRepo;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;

class NotificationController extends Controller
{
    private $notiRepo;
    public function __construct(NotificationRepo $notiRepo)
    {
        $this->notiRepo = $notiRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = $this->notiRepo->getNotifications();
        return NotificationResource::collection($notifications);
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
        $notification = $this->notiRepo->getNotificationByID($id);
        return NotificationResource::make($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $action = $this->notiRepo->deleteNotification($notification);
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
