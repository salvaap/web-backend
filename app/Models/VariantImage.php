<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VariantImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'media.variant_images';

    protected $fillable = [
        'image', 'variant_id'
    ];

    protected $casts = [
        'variant_id' => 'integer',
    ];

    public function variant() {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}
