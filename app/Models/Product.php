<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory.products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'featured_image',
        'is_variant', 'in_offer', 'offer_discount',
        'amount', 'preparation_days', 'category_id',
        'is_blocked', 'published_at', 'merchant_id',
        'condition_id', 'is_promoted',
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'integer',
        'in_offer' => 'boolean',
        'is_variant' => 'boolean',
        'is_promoted' => 'boolean',
        'offer_discount' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    /*public function categories() {
        return $this->belongsToMany('App\Models\Category')->as('categories');
    }*/

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function merchant() {
        return $this->belongsTo('App\Models\Merchant');
    }

    public function condition() {
        return $this->belongsTo('App\Models\Condition');
    }

    public function weight_range() {
        return $this->belongsTo('App\Models\WeightRange');
    }

    public function variants() {
        return $this->hasMany('App\Models\Variant');
    }

    public function attributes() {
        return $this->belongsToMany('App\Models\Attribute')->as('attributes');
    }

    public function product_attributes() {
        return $this->hasMany('App\Models\AttributeProduct');
    }
}
