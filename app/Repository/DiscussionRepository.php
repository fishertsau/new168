<?php


namespace App\Repository;

use Acme\Tool\Discussionable\Events\DiscussionRaised;
use Acme\Tool\Discussionable\Models\Discussion;
use App\User;
use Acme\Tool\Discussionable\Discussionable;

class DiscussionRepository
{
    public function raiseFor(Discussionable $model, User $user, $content)
    {

        $input = [
            'user_id' => $user->id,
            'content' => $content
        ];

        $discussion = $model->discussions()->create($input);

        event(new DiscussionRaised($discussion));

        return $discussion;
    }

    public function cease(Discussion $discussion)
    {
        $discussion->delete();
    }


    //
//    public function join($content)
//    {
//        if (!$content || ($content == '')) {
//            throw new Exception('No content is provided.(沒有輸入任何內容)');
//        }
//
//        $dialogue = new Dialogue([
//            'user_id' => Auth::id(),
//            'content' => $content
//        ]);
//
//        return $this->dialogues()->save($dialogue);
//    }
//
//    public function leave(Dialogue $dialogue)
//    {
//        Dialogue::
//        whereId($dialogue->id)
//            ->where('user_id', Auth::id())
//            ->delete();
//    }
//
//
//    public function getDialoguesCountAttribute()
//    {
//        return $this->dialogues()->count();
//    }

}