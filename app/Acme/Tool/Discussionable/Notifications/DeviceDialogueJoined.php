<?php

namespace Acme\Tool\Discussionable\Notifications;

use App\User;
use App\Models\Device\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Acme\Tool\Discussionable\Models\Dialogue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class DeviceDialogueJoined
 * @package Acme\Tool\Discussionable\Notifications
 */
class DeviceDialogueJoined extends Notification implements ShouldQueue
{
    use Queueable;

    protected $dialogue;
    protected $prospect;
    protected $device;

    /**
     * Create a new notification instance.
     *
     * @param User $prospect
     * @param Dialogue|User $dialogue
     * @param Device $device
     */
    public function __construct(User $prospect, Dialogue $dialogue, Device $device)
    {
        $this->dialogue = $dialogue;
        $this->prospect = $prospect;
        $this->device = $device;
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
        $name = $this->prospect->name;
        $deviceId = $this->device->id;
        $title = $this->device->title;
        $content = $this->dialogue->content;

        return (new MailMessage)
            ->success()
            ->subject('有人回答您關於設備的問題')
            ->greeting("$name 您好:")
            ->line("有人回答您關於$title 的問題")
            ->line("回答內容:$content")
            ->action('查看細節', 'http://abc168.space/devices/' . $deviceId . "#discussion");
    }
}
