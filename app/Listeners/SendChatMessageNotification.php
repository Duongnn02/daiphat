<?php

namespace App\Listeners;

use App\Events\NewChatMessage;
use App\Events\SendMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChatMessageNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMessage $event): void
    {
        // Lưu tin nhắn vào cơ sở dữ liệu

        // Gửi sự kiện thông báo đến các client đang lắng nghe
        broadcast(new SendMessage($event->message))->toOthers();
    }
}
