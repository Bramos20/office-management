<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskAssignedEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail']; // Sending email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Task Assigned: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new task has been assigned to you.')
            ->line('**Task:** ' . $this->task->title)
            ->line('**Status:** ' . ucfirst($this->task->status))
            ->line('**Due Date:** ' . ($this->task->due_date ? $this->task->due_date->toFormattedDateString() : 'N/A'))
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Please complete the task before the deadline.')
            ->salutation('Best Regards, Office Management System');
    }
}