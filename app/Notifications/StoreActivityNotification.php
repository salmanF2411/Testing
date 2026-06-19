<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoreActivityNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $activityType,
        public string $title,
        public string $message,
        public array $storeIds,
        public string $storeLabel,
        public string $url,
        public string $actorName,
        private array $channels = ['database'],
        private array $ccEmails = [],
    ) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $this->channels;
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject($this->title.' - Jayusman Minimarket')
            ->greeting('Halo '.$notifiable->name.',')
            ->line($this->message);

        if ($this->storeLabel !== '') {
            $mail->line('Cabang: '.$this->storeLabel);
        }

        foreach ($this->ccEmails as $email) {
            $mail->cc($email);
        }

        return $mail
            ->line('Dicatat oleh: '.$this->actorName)
            ->action('Lihat di Sistem', url($this->url))
            ->line('Notifikasi ini dikirim otomatis oleh sistem Jayusman Minimarket.');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'activity_type' => $this->activityType,
            'title' => $this->title,
            'message' => $this->message,
            'store_ids' => $this->storeIds,
            'store_label' => $this->storeLabel,
            'url' => $this->url,
            'actor_name' => $this->actorName,
        ];
    }
}
