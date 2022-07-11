<?php

namespace App\Http\Controllers;

use App\Models\UserRewardProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
Use App\Models\VillaBooking;
use Carbon\Carbon;
use App\Models\RewardProgram;
use App\Models\UserRewardBalance;
use App\Models\StaffRewardBalance;
use App\Models\TaxSetting;
use Illuminate\Support\Facades\DB;

class UserRewardController extends Controller
{
    public function index()
    {
        $this->authorize('user_reward_index');

        $data = UserRewardProgram::get();

        return view('new-admin.user_reward.index');
    }

    public function datatable()
    {
        $this->authorize('user_reward_index');
        return UserRewardProgram::datatables();
    }

    public function update_status($id)
    {
        $find = UserRewardProgram::where('id_user_reward', $id)->first();
        abort_if(!$find, 404);

        $status = false;

        if ($find->status == 0) {
            $find->update(array(
                'status' =>  1,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        } else {
            $find->update(array(
                'status' =>  0,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function create()
    {
        $this->authorize('user_reward_create');
        return view('new-admin.user_reward.create');
    }

    public function store(Request $request)
    {
        $this->authorize('user_reward_create');
        $request->validate([
            'reference_code' => 'required',
        ]);

        $data = UserRewardProgram::insert(array(
            'id_user' => Auth::user()->id,
            'reference_code' => $request->reference_code,
            'start_program' => $request->start_program,
            'end_program' => $request->end_program,
            'status' => $request->status,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_user_reward')
            ->with('success', 'Your data has been submited');
    }

    public function show($id)
    {
        $this->authorize('user_reward_update');
        $find = UserRewardProgram::where('id_user_reward', $id)->get();
        return view('new-admin.user_reward.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('user_reward_update');
        $find = UserRewardProgram::where('id_user_reward', $id)->first();
        $request->validate([
            'reference_code' => 'required',
        ]);

        $find->update(array(
            'id_user' => Auth::user()->id,
            'reference_code' => $request->reference_code,
            'start_program' => $request->start_program,
            'end_program' => $request->end_program,
            'status' => $request->status,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_user_reward')
            ->with('success', 'Your data has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('user_reward_delete');
        $find = UserRewardProgram::where('id_user_reward', $id)->first();
        $find->delete();
        return redirect()->route('admin_user_reward')
            ->with('success', 'Your data has been deleted');
    }


    //count reward
    public function reward_count()
    {
        $transaction = VillaBooking::where('no_invoice', "EZV-V0001")->first(); //edit soon into insert get id
        $tax = TaxSetting::select('total_tax')->first();
        $price = $transaction->total_price - ($tax->total_tax / 100 * $transaction->total_price); //price withoud tax and transfer fee
        $commission = VillaBooking::select('villa.commission')->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')->where('villa.id_villa', $transaction->id_villa)->first(); //percent
        $profit = ($commission->commission/100) * $price;
        $today = Carbon::today()->toDateString();

        //reward percent (edit soon)
        $level1 = RewardProgram::where('name', "Level 1")->first();
        $level2 = RewardProgram::where('name', "Level 2")->first();
        $level3 = RewardProgram::where('name', "Level 3")->first();
        $level4 = RewardProgram::where('name', "Level 4")->first();
        $staff = RewardProgram::where('name', "Staff")->first();

        //count
        $user = UserRewardProgram::where('id_user', $transaction->id_user)->first();

        if($user)
        {
            //user
            $parent1 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')
                        ->where('users.user_code', $user->reference_code)->first();
            $parent2 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')
                        ->where('users.user_code', $parent1->reference_code)->first();
            $parent3 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')
                        ->where('users.user_code', $parent2->reference_code)->first();
            $parent4 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')
                        ->where('users.user_code', $parent3->reference_code)->first();

            //cek if owner have reward program
            //if transaction is villa
                $owner = User::select('id')->join('villa', 'users.id', '=', 'villa.created_by', 'left')->where('villa.id_villa', $transaction->id_villa)->first();
            //elseif transaction is resstaurant

            //elseif transaction is hotel

            //elseif transaction is things to do

            //after get id owner cek if owner join reward program
            $ownerdata = UserRewardProgram::where('id_user', $owner->id)->first();

            if($ownerdata)
            {
                $owner_parent1 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')->where('users.user_code', $ownerdata->reference_code)->first();

                $owner_parent2 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')->where('users.user_code', $owner_parent1->reference_code)->first();

                $owner_parent3 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')->where('users.user_code', $owner_parent2->reference_code)->first();

                $owner_parent4 = UserRewardProgram::select('user_reward.*')->join('users', 'user_reward.id_user', '=', 'users.id', 'left')->where('users.user_code', $owner_parent3->reference_code)->first();
            }
        }

        if($parent1 && strtotime($parent1->start_program) <= strtotime($today) && strtotime($parent1->end_program) >= strtotime($today) && $parent1->status == 1)
        {
            $reward1 = ($level1->value/100) * $profit;
        }else{
            $reward1 = 0;
        }

        if($parent2 && strtotime($parent2->start_program) <= strtotime($today) && strtotime($parent2->end_program) >= strtotime($today) && $parent2->status == 1)
        {
            $reward2 = ($level2->value/100) * $profit;
        }else{
            $reward2 = 0;
        }

        if($parent3 && strtotime($parent3->start_program) <= strtotime($today) && strtotime($parent3->end_program) >= strtotime($today) && $parent3->status == 1)
        {
            $reward3 = ($level3->value/100) * $profit;
        }else{
            $reward3 = 0;
        }

        if($parent4 && strtotime($parent4->start_program) <= strtotime($today) && strtotime($parent4->end_program) >= strtotime($today) && $parent4->status == 1)
        {
            $reward4 = ($level4->value/100) * $profit;
        }else{
            $reward4 = 0;
        }

        if($owner_parent1 && strtotime($owner_parent1->start_program) <= strtotime($today) && strtotime($owner_parent1->end_program) >= strtotime($today) && $owner_parent1->status == 1)
        {
            $reward_owner1 = ($level1->value/100) * $profit;
        }else{
            $reward_owner1 = 0;
        }

        if($owner_parent2 && strtotime($owner_parent2->start_program) <= strtotime($today) && strtotime($owner_parent2->end_program) >= strtotime($today) && $owner_parent2->status == 1)
        {
            $reward_owner2 = ($level2->value/100) * $profit;
        }else{
            $reward_owner2 = 0;
        }

        if($owner_parent3 && strtotime($owner_parent3->start_program) <= strtotime($today) && strtotime($owner_parent3->end_program) >= strtotime($today) && $owner_parent3->status == 1)
        {
            $reward_owner3 = ($level3->value/100) * $profit;
        }else{
            $reward_owner3 = 0;
        }

        if($owner_parent4 && strtotime($owner_parent4->start_program) <= strtotime($today) && strtotime($owner_parent4->end_program) >= strtotime($today) && $owner_parent4->status == 1)
        {
            $reward_owner4 = ($level4->value/100) * $profit;
        }else{
            $reward_owner4 = 0;
        }

        $reward_staff = ($staff->value/100) * $profit;

        //store database
        if($parent1 && $reward1 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$parent1->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level1->value,
                'balance' => $reward1,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($parent2 && $reward2 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$parent2->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level2->value,
                'balance' => $reward2,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($parent3 && $reward3 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$parent3->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level3->value,
                'balance' => $reward3,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($parent4 && $reward4 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$parent4->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level4->value,
                'balance' => $reward4,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($owner_parent1 && $reward_owner1 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$owner_parent1->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level1->value,
                'balance' => $reward_owner1,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($owner_parent2 && $reward_owner2 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$owner_parent2->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level2->value,
                'balance' => $reward_owner2,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($owner_parent3 && $reward_owner3 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$owner_parent3->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level3->value,
                'balance' => $reward_owner3,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($owner_parent4 && $reward_owner4 != 0)
        {
            $data = UserRewardBalance::insert(array(
                'id_user_reward' =>$owner_parent4->id_user_reward,
                'no_invoice' => $transaction->no_invoice,
                'commission' => $level4->value,
                'balance' => $reward_owner4,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }

        if($reward_staff)
        {
            $data = StaffRewardBalance::insert(array(
                'no_invoice' => $transaction->no_invoice,
                'commission' => $staff->value,
                'balance' => $reward_staff,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));
        }


    }
}
