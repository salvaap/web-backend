<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access.actions'; //main_navigation

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'title', 'description',
        'action', 'icon', 'application_id', 'location',
        'order', 'is_visible', 'is_component',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'patient_id' => 'integer',
        'application_id' => 'string',
        'location' => 'string',
        'order' => 'integer',
        'is_visible' => 'boolean',
        'is_component' => 'boolean',
    ];

    public function profiles() {
        return $this->belongsToMany('App\Models\Profile')->as('profiles')->withPivot('create', 'read', 'update', 'delete');
    }

    /*public function option_profile() {
        return $this->hasMany('App\Models\OptionProfile');
    }*/

    public function parent() {
        return $this->belongsTo('App\Models\Action', 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany('App\Models\Action', 'parent_id', 'id');
    }
}
