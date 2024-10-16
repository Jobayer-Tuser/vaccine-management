<?php

namespace App\Enums;

enum NotificationSender: string
{
    case EMAIL = 'email';
    case SMS = 'sms';

    public function notificationSender() : NotificationSender
    {
        return match ($this){
            self::EMAIL     => new EmailSender(),
            self::SMS  => new PhoneMessageSender(),
        };
    }
}
