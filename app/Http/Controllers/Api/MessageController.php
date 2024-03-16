<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use Core\Repositories\MessageRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Requests\MessageRequests\MessageRequest;

class MessageController extends Controller
{
    private $messageRepo;
    public function __construct(MessageRepo $messageRepo)
    {
        $this->messageRepo = $messageRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = $this->messageRepo->getMessages();
        return MessageResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        $message = $this->messageRepo->createMessage($request);
        return response()->json([
            'Message' => 'تمت الإضافه بنجاح',
            'Message' => $message,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $message = $this->messageRepo->getMessageByID($id);
        return MessageResource::make($message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MessageRequest $request, Message $message)
    {
        $action = $this->messageRepo->updateMessage($request , $message);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Message' => $message,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $action = $this->messageRepo->deleteMessage($message);
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
