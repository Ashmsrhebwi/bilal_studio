<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ContactMessageNotification extends Notification
{
    public function __construct(private readonly ContactMessage $message) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("رسالة جديدة من {$this->message->name} - Sardini Studio")
            ->greeting('وصلت رسالة جديدة عبر نموذج التواصل!')
            ->line("**الاسم:** {$this->message->name}")
            ->line("**البريد:** {$this->message->email}")
            ->line("**الهاتف:** " . ($this->message->phone ?: 'غير محدد'))
            ->line("**نوع المشروع:** " . ($this->message->project_type ?: 'غير محدد'))
            ->line("**الرسالة:**")
            ->line($this->message->message)
            ->salutation('نظام Sardini Studio');
    }
}
