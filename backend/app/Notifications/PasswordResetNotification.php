<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $resetUrl,
        private readonly int $expiryMinutes
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('إعادة تعيين كلمة المرور - Sardini Studio')
            ->greeting('طلب إعادة تعيين كلمة المرور')
            ->line('لقد طلبت إعادة تعيين كلمة المرور للوحة تحكم Sardini Studio.')
            ->action('إعادة تعيين كلمة المرور', $this->resetUrl)
            ->line("الرابط صالح لمدة {$this->expiryMinutes} دقيقة فقط.")
            ->line('إذا لم تطلب ذلك، تجاهل هذا البريد.')
            ->salutation('فريق Sardini Studio');
    }
}
