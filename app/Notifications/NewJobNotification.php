<?php
namespace App\Notifications;

use App\Models\Job;
use Illuminate\Notifications\Notification;

class NewJobNotification extends Notification
{
    public function __construct(public Job $job) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'job_id'    => $this->job->id,
            'job_title' => $this->job->title,
            'location'  => $this->job->location,
            'job_type'  => $this->job->job_type,
        ];
    }
}