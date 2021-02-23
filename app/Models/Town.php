<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog.towns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'department_id'
    ];

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function merchants() {
        return $this->hasMany(Merchant::class);
    }
}
