<?php

namespace App\Notifications;

use App\Models\ConsultationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConsultationRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly ConsultationRequest $request) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("طلب استشارة جديد من {$this->request->name} - Sardini Studio")
            ->greeting('وصل طلب حجز استشارة جديد!')
            ->line("**الاسم:** {$this->request->name}")
            ->line("**البريد:** {$this->request->email}")
            ->line("**الهاتف:** {$this->request->phone}")
            ->line("**نوع المشروع:** " . ($this->request->project_type ?: 'غير محدد'))
            ->line("**التاريخ المفضل:** " . ($this->request->preferred_date?->format('Y-m-d') ?: 'غير محدد'))
            ->line("**الوقت المفضل:** " . ($this->request->preferred_time ?: 'غير محدد'))
            ->line("**ملاحظات:** " . ($this->request->notes ?: '—'))
            ->salutation('نظام Sardini Studio');
    }
}
