<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OtpNotification extends Notification
{
    public function __construct(
        private readonly string $code,
        private readonly int $expiryMinutes
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('رمز التحقق - Sardini Studio Admin')
            ->greeting('مرحباً بك في لوحة تحكم Sardini Studio')
            ->line('رمز التحقق (OTP) الخاص بك:')
            ->line("**{$this->code}**")
            ->line("هذا الرمز صالح لمدة {$this->expiryMinutes} دقائق ولا يمكن استخدامه سوى مرة واحدة.")
            ->line('إذا لم تطلب هذا الرمز، تجاهل هذا البريد.')
            ->salutation('فريق Sardini Studio');
    }
}
