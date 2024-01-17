<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    //All Permission
    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }
    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }
    public function StorePermission(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:permissions',
            'group_name' => 'required',
        ]);

        if ($validator) {
            Permission::create([
                'name' => $request->name,
                'group_name' => $request->group_name,
            ]);
        }

        $notification = array(
            'message' => 'Permission Create successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }
    public function EditPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    public function UpdatePermission(Request $request)
    {
        $pid = $request->id;
        Permission::findOrFail($pid)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = [
            'message' => 'Permission Update successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id)
    {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Delete successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function ImportPermission()
    {
        return view('backend.pages.permission.import_permission');
    }
    public function Export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }
    public function Import(Request $request)
    {
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Import Update successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //All Role
    public function AllRoles()
    {
        $roles = Role::all();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }
    public function AddRoles()
    {
        return view('backend.pages.roles.add_roles');
    }
    public function StoreRoles(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        if ($validator) {
            Role::create([
                'name' => $request->name,
            ]);
        }

        $notification = array(
            'message' => 'Role Create successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }
    public function EditRoles($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles', compact('role'));
    }

    public function UpdateRoles(Request $request)
    {
        $pid = $request->id;
        Role::findOrFail($pid)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = [
            'message' => 'Role Update successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Add Role Permission
    public function AddRolesPermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function StoreRolesPermission(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }
        $notification = [
            'message' => 'Role Permission Add successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles.permission')->with($notification);
    }
    public function AllRolesPermission()
    {
        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission', compact('roles'));
    }
    public function AdminEditRoles($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    }
    public function AdminRolesUpdate(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        $notification = [
            'message' => 'Role Permission Update successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AdminDeleteRoles($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = [
            'message' => 'Role Permission Deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
