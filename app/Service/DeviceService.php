<?php


namespace App\Service;


use Mail;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Device\Device;
use App\Repository\DeviceRepository;
use Acme\Tool\Discussionable\Models\Discussion;

/**
 * Class DeviceService
 * @package App\Http\Controllers\repository
 */
class DeviceService
{
    protected $deviceRepo;

    /**
     * DeviceService constructor.
     * @param $deviceRepository
     */
    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepo = $deviceRepository;
    }


    /**
     * @param $command
     * @param $data
     * @param Request $request
     * @return bool|mixed|string
     * @throws Exception
     */
    public function ajaxHandler($command, $data, Request $request)
    {
        switch ($command) {
            case 'raiseDiscussion':
                $content = $request->input('content');
                return $this->raiseDiscussion($data, $content);

            case 'ceaseDiscussion':
                return $this->ceaseDiscussion($data);

            case 'joinDiscussion':
                $content = $request->input('content');
                return app('discussionController')->join($data, $content);

            case 'leaveDiscussion':
                return app('discussionController')->leave($data);

            case 'toggleLike':
                return $this->toggleLike($data);

            case 'toggleActive':
                return $this->toggleActive($data);

            case 'sendSellerMail':
                return $this->sendSellerMail($data, $request);

            default:
                throw new Exception('Unknown Command!');
        }
    }

    /**
     * @param $id
     * @param $content
     * @return mixed
     * @internal param Device $device
     */
    public function raiseDiscussion($id, $content)
    {
        return Device::findOrfail($id)->raiseDiscussion($content);
    }

    /**
     * @param $discussionId
     * @return bool
     */
    public function ceaseDiscussion($discussionId)
    {
        $discussion = Discussion::findOrFail($discussionId);
        app('device')->ceaseDiscussion($discussion);
        return 'success';
    }

    /**
     * @param $id
     * @return string
     */
    public function toggleLike($id)
    {
        return Device::findOrFail($id)->toggleLike();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function toggleActive($id)
    {
        return Device::findOrFail($id)->togglePublish();
    }


    /**
     * @param $id
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function sendSellerMail($id, Request $request)
    {
        $device = Device::findOrFail($id);

        if ($device->contact_email == '') {
            throw new Exception('The device does not have contact email');
        }

        $user = new User();
        $user->email = $device->contact_email;

        $sender = $request->has('sender') ? $request->input('sender') : '';
        $content = $request->has('content') ? $request->input('content') : '';
        $tel = $request->has('tel') ? $request->input('tel') : '';
        $email = $request->has('email') ? $request->input('email') : '';

        $subject = 'Subject';
        $view = 'emails.device.contactSeller';

        $data = [
            'sender' => $sender,
            'title' => $device->title,
            'content' => $content,
            'tel' => $tel,
            'email' => $email
        ];

        Mail::queue($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)
                ->subject($subject);
        });

        return 'success';
    }
}