<?php

namespace App\Http\Middleware;

use Acme\Tool\Ownable\Ownable;
use Auth;
use Closure;
use Route;

/**
 * Class ModelOwner
 * Applicable with resourceful routing
 * @package App\Http\Middleware
 */
class ModelOwner
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $id
     * @param $model
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {

        $modelInstance = $this->modelInstance($model);

        if (!$this->modelOwnedByCurrentUser($modelInstance)) {
            return redirect()->back();
        }
        return $next($request);
    }

    /**
     * @param Ownable $model
     * @return mixed
     */
    private function modelOwnedByCurrentUser(Ownable $model)
    {
        return $model->ownedBy(Auth::user());
    }

    /**
     * @param $model
     * @param $id
     * @return object|string
     */
    private function modelInstance($model)
    {
        $id = Route::current()->parameter($model);

        if (!$this->isId($id)) {
            return $id;
        }

        return app($model)->findOrFail($id);
    }

    /**
     * @param $id
     * @return bool
     */
    private function isId($id)
    {
        return is_numeric($id);
    }
}
