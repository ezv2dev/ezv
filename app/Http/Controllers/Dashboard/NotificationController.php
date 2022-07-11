<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\NotificationOwner;
use App\Models\NotificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notification_account()
    {
        $notifications = NotificationUser::where('id_user', Auth::user()->id)->first();
        return view('new-admin.partner.account.notification.account_section', compact('notifications'));
    }


    public function recognition_achievements(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->recognitionAchievements;
        if ($off) {
            $notifications->update(array('recognition_achievements' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->recognitionAchievements[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->recognition_achievements = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('recognition_achievements' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function insights_tips(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->insightsTips;
        if ($off) {
            $notifications->update(array('insights_tips' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->insightsTips[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->insights_tips = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('insights_tips' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function pricing_trends_suggestions(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->pricingTrendsSuggestions;
        if ($off) {
            $notifications->update(array('pricing_trends_suggestions' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->pricingTrendsSuggestions[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->pricing_trends_suggestions = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('pricing_trends_suggestions' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function hosting_perks(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->hostingPerks;
        if ($off) {
            $notifications->update(array('hosting_perks' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->hostingPerks[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->hosting_perks = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('hosting_perks' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function news_updates(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->newsUpdates;
        if ($off) {
            $notifications->update(array('news_updates' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->newsUpdates[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->news_updates = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('news_updates' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function local_laws_regulations(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->localLawsRegulations;
        if ($off) {
            $notifications->update(array('local_laws_regulations' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->localLawsRegulations[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->local_laws_regulations = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('local_laws_regulations' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function inspiration_offers(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->inspirationOffers;
        if ($off) {
            $notifications->update(array('inspiration_offers' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->inspirationOffers[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->inspiration_offers = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('inspiration_offers' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function trip_planning(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->tripPlanning;
        if ($off) {
            $notifications->update(array('trip_planning' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->tripPlanning[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->trip_planning = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('trip_planning' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function news_programs(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->newsPrograms;
        if ($off) {
            $notifications->update(array('news_programs' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->newsPrograms[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->news_programs = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('news_programs' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function feedback(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->feedback;
        if ($off) {
            $notifications->update(array('feedback' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->feedback[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->feedback = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('feedback' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function travel_regulations(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->travelRegulations;
        if ($off) {
            $notifications->update(array('travel_regulations' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->travelRegulations[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->travel_regulations = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('travel_regulations' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function account_activity(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->accountActivity;
        if ($off) {
            $notifications->update(array('account_activity' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->accountActivity[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->account_activity = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('account_activity' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function listing_activity(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->listingActivity;
        if ($off) {
            $notifications->update(array('listing_activity' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->listingActivity[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->listing_activity = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('listing_activity' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function guest_policies(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->guestPolicies;
        if ($off) {
            $notifications->update(array('guest_policies' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->guestPolicies[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->guest_policies = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('guest_policies' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function host_policies(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->hostPolicies;
        if ($off) {
            $notifications->update(array('host_policies' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->hostPolicies[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->host_policies = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('host_policies' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function reminders(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->reminders;
        if ($off) {
            $notifications->update(array('reminders' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->reminders[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->reminders = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('reminders' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function messages(Request $request)
    {
        $notifications = NotificationUser::where('id_user', '=', Auth::user()->id)->first();

        $off = !$request->messages;
        if ($off) {
            $notifications->update(array('messages' => null));

            return back()->with('danger', 'You turned off email notifications');
        }

        $checked = $request->messages[0];

        if ($notifications == null) {
            // id user doesn't exist

            $store = new NotificationUser;
            $store->id_user = Auth::user()->id;
            $store->messages = $checked;
            $store->save();

            return back()->with('success', 'You have successfully turn on the email notification');
        } else {
            // id user exist

            $notifications->update(array('messages' => $checked));

            return back()->with('success', 'You have successfully turn on the email notification');
        }
    }

    public function notification_owner(Request $request)
    {
        $notificationOwners = NotificationOwner::where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('new-admin.notification_owner', compact('notificationOwners'));
    }
}
