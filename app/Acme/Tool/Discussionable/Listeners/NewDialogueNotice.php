<?php


namespace Acme\Tool\Discussionable\Listeners;

use App\Models\Device\Device;
use App\User;
use Acme\Tool\Discussionable\Notifications\DeviceDialogueJoined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Acme\Tool\Discussionable\Events\DialogueJoined;


/**
 * Class NewDialogueNotice
 * @package Acme\Tool\Discussionable\Listeners
 */
class NewDialogueNotice implements shouldQueue
{
    /**
     * @param DialogueJoined $dialogueJoined
     */
    public function handle(DialogueJoined $dialogueJoined)
    {
        $discussion = $dialogueJoined->dialogue->discussion;

        $prospect = User::findOrFail($discussion->user_id);
        $device = Device::findOrfail($discussion->discussionable_id);

        $prospect->notify(
            new DeviceDialogueJoined($prospect, $dialogueJoined->dialogue, $device)
        );
    }
}