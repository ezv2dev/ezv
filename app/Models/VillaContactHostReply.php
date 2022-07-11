<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaContactHostReply extends Model
{
    protected $fillable = [
        'id_message',
        'message',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'approve_at',
        'approve_by',
        'disapprove_at',
        'disapprove_by'
    ];

    protected $table = 'villa_contact_host_reply';
    protected $primaryKey = 'id_reply';

    public function conversation()
    {
        return $this->belongsTo(VillaContactHost::class, 'id_message', 'id_message')->where('approve_by', '!=', null)->where('disapprove_by', '=', null);
    }

    public function getConversationSenderTypeAttribute()
    {
        return 'owner';
    }

    public function getApproveStatusAttribute()
    {
        if($this->approve_by != null) {
            return 'approved';
        }
        if($this->disapprove_by != null) {
            return 'disapprove';
        }
        return 'waiting';
    }

    public function getSenderNameAttribute()
    {
        return $this->conversation->owner->name;
    }
}
