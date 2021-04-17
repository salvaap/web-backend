<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory.attribute_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_id', 'product_id',
    ];

    /**
     * Disabling timestamps for model.
     *
     * @var string
     */
    public $timestamps = false;

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function attribute() {
        return $this->belongsTo('App\Models\Attribute');
    }

    public function values() {
        return $this->belongsToMany('App\Models\Value')->as('values');
    }
}
