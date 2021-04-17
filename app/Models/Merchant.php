<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access.merchants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'owner_id', 'address',
        'contract_file', 'logo', 'approved_at',
        'town_id', 'phone'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'approved_at',
    ];

    public function owner() {
        return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    public function accounts() {
        return $this->hasMany('App\Models\Account');
    }

    public function products() {
        return $this->hasMany('App\Models\Product');
    }

    public function town() {
        return $this->belongsTo('App\Models\Town');
    }
}
