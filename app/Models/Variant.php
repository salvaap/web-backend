<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory.variants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'sku', 'featured_image',
        'price', 'amount', 'length',
        'width', 'height', 'weight_range_id',
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'width' => 'float',
        'height' => 'float',
        'length' => 'float',
        'amount' => 'integer',
        'weight_range_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function values() {
        return $this->belongsToMany(Value::class)->as('values');
    }

    public function images() {
        return $this->hasMany(VariantImage::class, 'variant_id', 'id');
    }
}
