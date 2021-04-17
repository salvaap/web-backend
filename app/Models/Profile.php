<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access.profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function actions() {
        return $this->belongsToMany('App\Models\Action')->as('actions')->withPivot('create', 'read', 'update', 'delete');
    }

    /*public function action_profile() {
        return $this->hasMany('App\Models\ActionProfile');
    }*/

    public function users() {
        return $this->hasMany('App\Models\User');
    }
}
