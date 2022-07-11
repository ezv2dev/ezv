<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $this->authorize('permission_index');

        // return view('admin.permission.index');
        return view('new-admin.permission.index');
    }

    public function datatable()
    {
        $this->authorize('permission_index');

        $data = DB::table('permissions')->select('*')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .="<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_permission_delete', $data->id) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-trash-can-undo'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Delete</div>
                                    Delete data
                                </div>
                            </a>
                            {{-- <div class='dropdown-divider m-0'></div> --}}
                        </div>
                    </li>
                ";
                $aksi .="</center>";
                return $aksi;
                })
            ->rawColumns(['aksi'])->make(true);
    }

    public function create()
    {
        $this->authorize('permission_create');
        // return view('admin.permission.create');
        return view('new-admin.permission.create');
    }

    public function store(Request $request){
        $this->authorize('permission_create');
        if($request->name1 != null){
            $data = Permission::insert(array(
                'name' => $request->name1,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            ));
        }
        if($request->name2 != null){
            $data = Permission::insert(array(
                'name' => $request->name2,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            ));
        }
        if($request->name3 != null){
            $data = Permission::insert(array(
                'name' => $request->name3,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            ));
        }
        if($request->name4 != null){
            $data = Permission::insert(array(
                'name' => $request->name4,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            ));
        }
        if($request->name5 != null){
            $data = Permission::insert(array(
                'name' => $request->name5,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            ));
        }

        return redirect()->route('admin_permission')
            ->with('success', 'Your data has been submited');
    }

    public function destroy($id)
    {
        $this->authorize('permission_delete');
        $find = DB::table('permissions')->where('id', $id)->delete();
        return redirect()->route('admin_permission')
            ->with('success', 'Your data has been deleted');
    }

    public function role()
    {
        $this->authorize('permission_index');
        // return view('admin.permission.role');
        return view('new-admin.permission.role');
    }

    public function role_datatable()
    {
        $this->authorize('permission_index');
        $data = DB::table('roles')->select('*')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                $aksi .="<center>";
                // $aksi .="
                //     <div class='dropdown'>
                //     <button type='button' class='btn button-admin dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //         Action
                //     </button>
                //     <div class='dropdown-menu admin-action-dropdown dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                //             <a class='dropdown-item' href='/admin/role_permission/".$data->id."'>Set Permission</a>
                //             <a class='dropdown-item' href='/admin/permission/delete/".$data->id."'>Delete</a>
                //         </div>
                //     </div>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Action</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='" . route('admin_role_permission', $data->id) . "'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa-solid fa-trash-can-undo'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Set Permission</div>
                                    Set Permission for this role
                                </div>
                            </a>
                        </div>
                    </li>
                ";
                $aksi .="</center>";
                return $aksi;
                })
            ->rawColumns(['aksi'])->make(true);
    }

    public function role_permission($id)
    {
        $this->authorize('permission_create');
        // $role = DB::table('roles')->select('*')->where('id',$id)->first();
        $role = Role::find($id);
        $permission = DB::table('permissions')->select('*')->get();
        // return view('admin.permission.set_permission', compact('role', 'permission'));
        return view('new-admin.permission.set_permission', compact('role', 'permission'));
    }

    public function role_permission_store(Request $request)
    {
        $this->authorize('permission_create');
        $id_role = $request->id_role;
        $data = $request->except(['_token', 'id_role']);

        DB::table('permission_role')->where('role_id', $id_role)->delete();

        foreach($data as $item){
            $role = DB::table('permission_role')->insert(array(
                'role_id' => $id_role,
                'permission_id' => $item,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            ));
        }
        return redirect()->route('admin_permission_role_index')
            ->with('success', 'Your data has been submited');
    }
}
