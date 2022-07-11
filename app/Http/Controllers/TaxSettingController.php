<?php

namespace App\Http\Controllers;

use App\Models\TaxSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxSettingController extends Controller
{
    public function index()
    {
        $this->authorize('tax_index');

        $data = TaxSetting::get();

        return view('new-admin.tax_setting.index');
    }

    public function datatable()
    {
        $this->authorize('tax_index');
        return TaxSetting::datatables();
    }

    public function create()
    {
        $this->authorize('tax_create');
        return view('new-admin.tax_setting.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('tax_create');
        $request->validate([
            'total_tax' => 'required',
        ]);

        $data = TaxSetting::insert(array(
            'total_tax' => $request->total_tax,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_tax_setting')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('tax_update');
        $find = TaxSetting::where('id_tax', $id)->get();
        return view('new-admin.tax_setting.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('tax_update');
        $find = TaxSetting::where('id_tax', $id)->first();
        $request->validate([
            'total_tax' => 'required',
        ]);

        $find->update(array(
            'total_tax' => $request->total_tax,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_tax_setting')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('tax_delete');
        $find = TaxSetting::where('id_tax', $id)->first();
        $find->delete();
        return redirect()->route('admin_tax_setting')
            ->with('success', 'Your data has been deleted');
    }
}
