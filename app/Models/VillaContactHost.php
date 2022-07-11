<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DataTables;

class VillaContactHost extends Model
{
    protected $fillable = [
        'id_user',
        'id_owner',
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

    protected $table = 'villa_contact_host';
    protected $primaryKey = 'id_message';

    public function scopePartnerConversations()
    {
        $data = [];
        if(auth()->check() && auth()->user()->role->name == 'partner') {
            $data = self::with(['conversationReply'])->where('id_owner', auth()->user()->id)
                ->where('approve_by', '!=', null)
                ->where('disapprove_by', '=', null)
                ->orderBy('created_at')->get();
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sender', function ($data) {
                return $data->sender_name;
            })
            ->addColumn('senderType', function ($data) {
                return $data->conversation_sender_type;
            })
            ->addColumn('replyStatus', function ($data) {
                if($data->is_reply) {
                    return 'yes';
                } else {
                    return 'no';
                }
            })
            ->addColumn('aksi', function ($data) {
                $aksi = "";
                // $aksi .= "
                //     <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                //         <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                //             <div class='d-none d-md-inline font-weight-500'>Action</div>
                //             <i class='fas fa-chevron-right dropdown-arrow'></i>
                //         </a>
                //         <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                //             <a class='dropdown-item py-3' onclick='view_message('hello')' href='#!'>
                //                 <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                //                 <div>
                //                     <div class='small text-gray-500'>View</div>
                //                     View data details
                //                 </div>
                //             </a>
                //             {{-- <div class='dropdown-divider m-0'></div> --}}
                //         </div>
                //     </li>
                // ";
                $aksi .= "<a href='#!' onclick='view_villa_message(".$data->id_message.")'>detail</a>";
                return $aksi;
            })
            ->rawColumns(['aksi', 'status', 'price'])->make(true);

    }

    public function conversationReply()
    {
        if(auth()->check()) {
            if(auth()->user()->role->name == 'partner') {
                return $this->hasOne(VillaContactHostReply::class, 'id_message', 'id_message');
            }
        }
        return $this->hasOne(VillaContactHostReply::class, 'id_message', 'id_message')->where('approve_by', '!=', null)->where('disapprove_by', '=', null);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_owner', 'id');
    }

    public function getConversationSenderTypeAttribute()
    {
        return 'user';
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
        return $this->user->name;
    }

    public function getIsReplyAttribute()
    {
        if($this->conversationReply) {
            return true;
        }
        return false;
    }
}
