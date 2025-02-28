<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\LeaveRequest;

class LeaveRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $leaveRequest;
    protected $status;

    public function __construct(LeaveRequest $leaveRequest, $status = 'pending')
    {
        $this->leaveRequest = $leaveRequest;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $message = new MailMessage();
        $message->subject('Leave Request ' . ucfirst($this->status))
                ->greeting('Hello ' . $notifiable->name . ',')
                ->line('Your leave request has been ' . $this->status . '.')
                ->line('Start Date: ' . $this->leaveRequest->start_date)
                ->line('End Date: ' . $this->leaveRequest->end_date)
                ->line('Reason: ' . $this->leaveRequest->reason)
                ->action('View Leave Request', url('/leaves'));

        return $message;
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your leave request has been ' . $this->status . '.',
            'leave_id' => $this->leaveRequest->id
        ];
    }
}
