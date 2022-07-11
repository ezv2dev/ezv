<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $table = 'notifications_user';
    protected $primaryKey = 'id_notifications_user';

    protected $fillable = ['id_user', 'recognition_achievements', 'insights_tips', 'pricing_trends_suggestions', 'hosting_perks', 'news_updates', 'local_laws_regulations', 'inspiration_offers', 'trip_planning', 'news_programs', 'feedback', 'travel_regulations', 'account_activity', 'listing_activity', 'guest_policies', 'host_policies', 'reminders'];
}
