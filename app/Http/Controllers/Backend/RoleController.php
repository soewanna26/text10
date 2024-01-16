<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
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
}
