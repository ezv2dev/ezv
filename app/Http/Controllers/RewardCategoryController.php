<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RewardProgram;
use Illuminate\Support\Facades\Auth;

class RewardCategoryController extends Controller
{
    public function index()
    {
        $this->authorize('reward_index');

        $data = RewardProgram::get();

        return view('new-admin.reward_program.index');
    }

    public function datatable()
    {
        $this->authorize('reward_index');
        return RewardProgram::datatables();
    }

    public function create()
    {
        $this->authorize('reward_create');
        return view('new-admin.reward_program.create');
    }

    public function store(Request $request)
    {
        $this->authorize('reward_create');
        $request->validate([
            'name' => 'required',
        ]);

        $data = RewardProgram::insert(array(
            'name' => $request->name,
            'value' => $request->value,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_reward_category')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('reward_update');
        $find = RewardProgram::where('id_reward_category', $id)->get();
        return view('new-admin.reward_program.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('reward_update');
        $find = RewardProgram::where('id_reward_category', $id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $find->update(array(
            'name' => $request->name,
            'value' => $request->value,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_reward_category')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('reward_delete');
        $find = RewardProgram::where('id_reward_category', $id)->first();
        $find->delete();
        return redirect()->route('admin_reward_category')
            ->with('success', 'Your data has been deleted');
    }
}
