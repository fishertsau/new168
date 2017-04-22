<?php

namespace App\Http\Controllers\Api;

use App;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\DiscussionRepository;
use Acme\Tool\Discussionable\Models\Dialogue;
use Acme\Tool\Discussionable\Models\Discussion;

/**
 * Class DiscussionsController
 * @package App\Http\Controllers
 */
class DiscussionsController extends Controller
{
    /**
     * @var DiscussionRepository
     */
    private $discussionRepo;


    /**
     * DiscussionsController constructor.
     * @param DiscussionRepository $discussionRepository
     */
    public function __construct(DiscussionRepository $discussionRepository)
    {
        $this->discussionRepo = $discussionRepository;
    }


    public function store(Request $request, $model, $id)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $modelInstance = App::make($model)->findOrFail($id);
        $user = Auth::user();

        $discussion = $this->discussionRepo
            ->raiseFor(
                $modelInstance,
                $user,
                $request->input('content')
            );

        return [
            'status' => 'success',
            'message' => 'a discussion created',
            'discussion' => $discussion
        ];
    }


    public function destroy(Discussion $discussion)
    {
        if (!$discussion->ownedBy(Auth::user())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'not the owner'
            ], 500);
        }

        $this->discussionRepo->cease($discussion);

        return response()->json([
            'status' => 'success',
            'message' => 'a discussion is ceased.'
        ]);
    }

//    /**
//     * @param $id
//     * @param Request $request
//     * @return mixed
//     */
//    public function join($id, Request $request)
//    {
//        $discussion = Discussion::findOrFail($id);
//
//        return $discussion->join($request->input('content'));
//    }
//
//    /**
//     * @param $id
//     * @return string
//     */
//    public function leave($id)
//    {
//        $dialogue = Dialogue::findOrFail($id);
//        (new Discussion())->leave($dialogue);
//
//        return 'success';
//    }
}
