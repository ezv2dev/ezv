<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CollaboratorReview;

class Collaborator extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_collab', 'uid', 'gender', 'grade', 'description', 'short_description', 'id_location', 'address', 'latitude', 'longitude', 'phone', 'email', 'price', 'discount', 'image', 'status', 'views', 'created_by', 'updated_by'
    ];

    protected $table = 'collaborator';
    protected $primaryKey = 'id_collab';

    const GENDER = ['male', 'female'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id_location');
    }

    public function collaboratorHasCategory()
    {
        return $this->hasMany(CollaboratorHasCategory::class, 'id_collab', 'id_collab');
    }

    public function category()
    {
        return $this->belongsToMany(CollaboratorCategory::class, 'collaborator_has_category', 'id_collab', 'id_collab_category', 'id_collab', 'id_collab_category');
    }

    public function collaboratorHasFilter()
    {
        return $this->hasMany(CollaboratorHasFilter::class, 'id_collab', 'id_collab');
    }

    public function collaboratorSocial()
    {
        return $this->hasOne(CollaboratorSocialMedia::class, 'id_collab', 'id_collab');
    }

    public function detailReview()
    {
        return $this->hasOne(CollaboratorDetailReview::class, 'id_collab', 'id_collab');
    }

    public function getUserReviewAttribute()
    {
        if (auth()->check()) {
            $isExist = CollaboratorReview::where('id_collab', $this->id_collab)->where('created_by', auth()->user()->id)->first();
            if($isExist){
                return $isExist;
            }
        }
        return false;
    }
}
