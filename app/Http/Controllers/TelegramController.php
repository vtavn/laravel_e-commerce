<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function getChatId()
    {
        $activities = Telegram::getUpdates();
        $newChat = (count($activities)) - 1;
        return $activities[$newChat]->message->from->id;
    }

    public function sendMsg()
    {
        $chatId = $this->getChatId();

        $text = "Hello\n"
            ."<b>Add New Bot: </b>\n"
            ."<b>Message: </b>\n";

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return true;
    }
}
