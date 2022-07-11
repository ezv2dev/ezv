<?php

namespace App\Http\Controllers;

use App\Models\StaffRewardBalance;
use Illuminate\Http\Request;

class StaffRewardBalanceController extends Controller
{
    public function index()
    {
        $this->authorize('staff_reward_balance_index');

        $data = StaffRewardBalance::get();

        return view('new-admin.staff_reward_balance.index', compact('data'));
    }

    public function datatable()
    {
        $this->authorize('staff_reward_balance_index');
        return StaffRewardBalance::datatables();
    }
}
