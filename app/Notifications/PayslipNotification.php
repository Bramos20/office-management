<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Payroll;

class PayslipNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $payroll;

    public function __construct(Payroll $payroll)
    {
        $this->payroll = $payroll;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('💰 Payslip for ' . $this->payroll->pay_date)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your salary details for ' . $this->payroll->pay_date . ':')
            ->line('**Basic Salary:** $' . number_format($this->payroll->basic_salary, 2))
            ->line('**Tax:** $' . number_format($this->payroll->tax, 2))
            ->line('**Deductions:** $' . number_format($this->payroll->deductions, 2))
            ->line('**Net Salary:** $' . number_format($this->payroll->net_salary, 2))
            ->action('View Payroll Details', url('/payroll/' . $this->payroll->id))
            ->line('Thank you for your hard work!')
            ->salutation('Best Regards, Office Management System');
    }
}

