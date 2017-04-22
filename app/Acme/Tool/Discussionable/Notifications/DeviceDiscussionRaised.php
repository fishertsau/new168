<?php

namespace Acme\Tool\Discussionable\Notifications;

use App\User;
use App\Models\Device\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Acme\Tool\Discussionable\Models\Discussion;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class DeviceDiscussionRaised
 * @package Acme\Tool\Discussionable\Notifications
 */
class DeviceDiscussionRaised extends Notification implements ShouldQueue
{
    use Queueable;

    protected $discussion;
    protected $owner;

    /**
     * Create a new notification instance.
     *
     * @param Discussion $discussion
     * @param User $user
     */
    public function __construct(Discussion $discussion, User $user)
    {
        $this->discussion = $discussion;
        $this->owner = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = $this->owner->name;
        $device = Device::findOrFail($this->discussion->discussionable_id);
        $content = $this->discussion->content;

        return (new MailMessage)
            ->success()
            ->subject('有人詢問設備相關問題')
            ->greeting("$name 您好:")
            ->line("有人詢問關於您要販賣的設備:$device->title")
            ->line("問題內容:$content")
            ->action('回答問題', 'http://abc168.space/devices/' . $device->id . "#discussion");
    }
}
