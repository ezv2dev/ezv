<?php

namespace App\Http\Controllers;

use App\Models\UserRewardBalance;
use Illuminate\Http\Request;

class UserRewardBalanceController extends Controller
{
    public function index()
    {
        $this->authorize('user_reward_balance_index');

        $data = UserRewardBalance::get();

        return view('new-admin.user_reward_balance.index', compact('data'));
    }

    public function datatable()
    {
        $this->authorize('user_reward_balance_index');
        return UserRewardBalance::datatables();
    }
}
