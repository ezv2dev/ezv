<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelView extends Model
{
    protected $table = 'hotel_views';
    protected $primaryKey = 'id';

    protected $fillable = ['id_hotel', 'url', 'session_id', 'user_id', 'ip', 'created_at', 'updated_at'];

    public function HotelView()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public static function createViewLog($hotel)
    {
        // dd($hotel[0]);
        $hotelViews = new HotelView();
        $hotelViews->id_hotel = $hotel[0]->id_hotel;
        $hotelViews->name = $hotel[0]->name;
        $hotelViews->url = request()->url();
        $hotelViews->session_id = request()->getSession()->getId();
        $hotelViews->user_id = (auth()->check()) ? auth()->id() : null;
        $hotelViews->ip = request()->ip();
        $hotelViews->save();
    }
}
