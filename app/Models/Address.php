<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog.addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'additional_information',
        'postal_code', 'town_id', 'user_id'
    ];

    public function town() {
        return $this->belongsTo(Town::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
