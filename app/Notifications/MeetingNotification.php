<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Meeting;

class MeetingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📅 New Meeting Scheduled: ' . $this->meeting->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have been invited to a meeting.')
            ->line('**Title:** ' . $this->meeting->title)
            ->line('**Scheduled At:** ' . $this->meeting->scheduled_at)
            ->line('**Organizer:** ' . $this->meeting->organizer->name)
            ->action('View Details', url('/meetings/' . $this->meeting->id))
            ->line('Please be on time.')
            ->salutation('Best Regards, Office Management System');
    }
}