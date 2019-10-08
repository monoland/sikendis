<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ServiceCreated extends Notification
{
    use Queueable;

    protected $service;

    /**
     * Create a new notification instance.
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'service' => $this->service,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'service' => $this->service,
        ];
    }
}
