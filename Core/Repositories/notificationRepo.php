<?php
namespace Core\Repositories;

use Exception;
use App\Models\Notification;

class NotificationRepo{
    public function getNotifications() {
        return Notification::select('id' , 'body')->paginate(5);
    }

    public function getNotificationByID($id){
        $Notification = Notification::findOrFail($id);
        if (! $Notification ) {
            throw new Exception(' غير موجود ..!!'  , 403); 
        }
        return $Notification;
    }

    public function deleteNotification(Notification $Notification){
        return $Notification->delete();
    }
}