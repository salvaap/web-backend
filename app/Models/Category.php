<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory.categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'description',
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'patient_id' => 'integer',
    ];

    public function parent() {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    /*public function products() {
        return $this->belongsToMany('App\Models\Product')->as('products');
    }*/

    public function products() {
        return $this->hasMany('App\Models\Product');
    }
}
