<?php namespace App\Http\Controllers\Auth\FisherCustom;

use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\View;
use Storage;
use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Models\Authorization\Role;
use App\Http\Controllers\Controller;
use App\Exceptions\RoleNotFoundException;

/**
 * Class RoleController
 * @package App\Http\Controllers\Auth\FisherCustom
 */
class RoleController extends Controller
{
    /*** 查詢條件名稱***/
    protected static $queryTermName = 'roleQueryTerm';

    /** 查詢條件**/
    protected static $queryTermList = [
        'category' => ''];

    /**
     * Show a list of all the role.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);

        $queryTerm = makeQueryForSearch(Session::get(self::$queryTermName),
            collect(self::$queryTermList)->keys());

        $roles =
            Role::where('category', 'like', $queryTerm['category'])
                ->orderBy('category')->get();

        return view('admin/auth/role/index', compact('roles'));
    }

    /**
     * Group create.
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create-role');

        return view('admin.auth.role.create');
    }

    /**
     * Group create form processing.
     *
     * @param Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        $this->authorize('create-role');

        $role = $this->createRole($request);

        return redirect($this->redirectToEdit($role->id));
    }

    protected function createRole(Request $request)
    {
        $role = Role::create($request->all());
        $role->save();
        return $role;
    }

    protected function redirectToEdit($id)
    {
        return 'admin\role\\' . $id . '\edit';
    }

    /**
     * Group update.
     *
     * @param  int $id
     * @param PermissionController $permissionController
     * @return View
     */
    public function edit($id = null, PermissionController $permissionController)
    {
        $this->authorize('edit-role');
        try {
            $role = Role::findOrFail($id);
        } catch (RoleNotFoundException $e) {
            //role not found error message

            return Redirect::route('role');
        }

        $rolePermissionList = $this->getRolePermission($role);
        return view('admin/auth/role/edit', compact('role', 'rolePermissionList'));
    }

    protected function getRolePermission(Role $role)
    {
        return $role->permissions->groupBy('id')->keys();
    }

    /**
     * Group update form processing page.
     *
     * @param RoleRequest|Request $request
     * @param  int $id
     * @param PermissionController $permissionController
     * @return Redirect
     */
    public function update(Request $request, $id = null, PermissionController $permissionController)
    {
        $this->authorize('edit-role');

        try {
            $role = Role::findOrFail($id);
        } catch (RoleNotFoundException $e) {
            // Redirect to the role management page
            //Group not found error message
            return Redirect::route('role');
        }

        // Was the role updated?
        if ($role->update($request->all())) {
            // Redirect to the group page
            $permissionController::syncRolePermission($request->input('permission_list'), $role);

            flash()->success('您剛剛修改了群組設定!');

            return redirect('admin\role');
        } else {
            //show error message, role not update
            return Redirect::route('role', $id);
        }

    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
    }

    /**
     * Delete the given group.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id = null)
    {

    }


    public function saveListToStorage()
    {
        $roleList = Role::all();

        $result = $this->generateJson($roleList);
        //persist Json
        Storage::put('role.json', $result);

        return redirect()->back();
    }


    protected function generateJson($roleList)
    {
        $oneRoleFormat = '{"name":"%s","description":"%s","category":"%s"}';

        //make an array to designated-format JSON
        $result = '';
        $index = 0;
        foreach ($roleList as $role) {
            $permissionString = sprintf(
                $oneRoleFormat,
                $role->name,
                $role->description,
                $role->category);

            $comma = ($index == 0) ? '' : ",";
            $result .= $comma . $permissionString;
            $index++;
        }
        $result = '[' . $result . ']';

        return $result;
    }


    public function indexByCat()
    {
        $roleList = Role::getRoleList();
        return view('admin/auth/role/indexByCat', compact('roleList'));
    }

    /**
     * persist the model entry's associated data into the database.
     * @param array $tag_list
     * @param $model
     * @return bool
     * @internal param $request
     */
    public static function syncUserRole($role_list = [], $user)
    {
        $role_list = ($role_list) ? $role_list : [];

        $user->roles()->sync($role_list);

        return true;
    }

}
