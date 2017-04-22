<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AjaxController
 * @package App\Http\Controllers\Admin
 */
class AjaxController extends Controller
{
    protected static $functionMap = [
        'command' =>
            'controller@method',
        'leftMenuVisibility' =>
            'App\Http\Controllers\Admin\LayoutDisplayController@changeLeftMenuVisibilitySetting',
        'reRankOccasion' =>
            'App\Http\Controllers\Admin\Device\OccasionsController@reRank'
    ];


    /**
     * @param $command
     * @param $data
     * @param Request|null $request
     * @return mixed
     */
    public function handler($command, $data, Request $request = null)
    {
        $funs = $this->getMethod($command);
        return (new $funs[0])->$funs[1]($data, $request);
    }

//    public function getHandler($command, $data, Request $request)
//    {
//        $funs = $this->getMethod($command);
//        return (new $funs[0])->$funs[1]($data, $request);
//    }
//
//
//    public function postHandler($command, $data = null, Request $request)
//    {
//        $funs = $this->getMethod($command);
//
//        return (new $funs[0])->$funs[1]($data, $request);
//    }


    protected function getMethod($command)
    {
        return explode('@', self::$functionMap[$command]);
    }

}
