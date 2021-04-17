<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory.attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function values() {
        return $this->hasMany('App\Models\Value');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product')->as('products');
    }

    public function attribute_products() {
        return $this->hasMany('App\Models\AttributeProduct');
    }
}
