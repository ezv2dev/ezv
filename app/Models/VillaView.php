<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaView extends Model
{
    protected $table = 'villa_views';
    protected $primaryKey = 'id';

    protected $fillable = ['id_villa', 'titleslug', 'url', 'session_id', 'user_id', 'ip', 'agent', 'created_at', 'updated_at'];

    public function villaView()
    {
        return $this->belongsTo(Villa::class, 'id_villa', 'id_villa');
    }

    public static function createViewLog($villa)
    {
        // dd($villa[0]);
        $villaViews = new VillaView();
        $villaViews->id_villa = $villa[0]->id_villa;
        $villaViews->name = $villa[0]->name;
        $villaViews->url = request()->url();
        $villaViews->session_id = request()->getSession()->getId();
        $villaViews->user_id = (auth()->check()) ? auth()->id() : null;
        $villaViews->ip = request()->ip();
        $villaViews->save();
    }
}
