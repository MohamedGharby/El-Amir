<?php
namespace Core\Repositories;

use Exception;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageRepo{
    public function getMessages() {
        return Message::select('title','body')->get();
    }

    public function getMessageByID($id){
        $message = Message::findOrFail($id);
        if (! $message ) {
            throw new Exception(' غير موجود ..!!'  , 403); 
        }
        return $message;
    }

    public function createMessage(Request $request){
        $data = $request->validated();
        return Message::create($data);
    }

    public function updateMessage(Request $request , Message $message){
        $data = $request->validated();
        return $message->update($data);
    }

    public function deleteMessage(Message $message){
        return $message->delete();
    }
}