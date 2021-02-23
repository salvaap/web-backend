<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueVariant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory.value_variant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value_id', 'variant_id',
    ];

    /**
     * Disabling timestamps for model.
     *
     * @var string
     */
    public $timestamps = false;

    public function variant() {
        return $this->belongsTo('App\Models\Variant');
    }

    public function value() {
        return $this->belongsTo('App\Models\Value');
    }
}
