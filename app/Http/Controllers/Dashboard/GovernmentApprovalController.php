<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Government;
use Auth;

class GovernmentApprovalController extends Controller
{
    public function index()
    {
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']);
        abort_if($condition, 403);

        return view('new-admin.approval_government.index');
    }

    public function approval_index()
    {
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']);
        abort_if($condition, 403);

        return view('new-admin.approval_government.approve');
    }

    public function datatable()
    {
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']);
        abort_if($condition, 403);

        return government::datatables();
    }

    public function datatableapproval()
    {
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']);
        abort_if($condition, 403);

        return government::datatablesapproval();
    }

    public function approve($id)
    {
        // $this->authorize('listvilla_delete');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']);
        abort_if($condition, 403);

        $status = 500;

        try {
            $find = Government::where('id_government', $id)->first();
            $find->update(array(
                'approved_status' =>  1,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'approved_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('government_approval_index')
                ->with('success', 'Data has been approve');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
