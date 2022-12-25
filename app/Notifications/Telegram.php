<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class Telegram extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ["telegram"];
    }

    public function toTelegram($notifiable)
    {
        $url = url('/login/');

        return TelegramMessage::create()
            // Optional recipient user id.
//            ->to($notifiable->telegram_user_id)
            // Markdown supported.
            ->content("Привет!\n")
            ->line("Я бот с уведомлениями.");

            // (Optional) Blade template for the content.
            // ->view('notification', ['url' => $url])

            // (Optional) Inline Buttons
//            ->button('На главную', $url);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
