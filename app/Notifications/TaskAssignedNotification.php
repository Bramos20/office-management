<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Task;

class TaskAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Task Assigned: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have been assigned a new task: ' . $this->task->title)
            ->line('Description: ' . $this->task->description)
            ->line('Deadline: ' . ($this->task->deadline ?? 'No deadline set'))
            ->action('View Task', url('/tasks'))
            ->line('Please complete the task on time.');
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'message' => 'A new task has been assigned to you.',
        ]);
    }
}
