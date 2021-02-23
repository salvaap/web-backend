<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'media.galleries';

    protected $fillable = [
        'merchant_id', 'type',
    ];

    protected $dates = [];

    protected $casts = [
        'merchant_id' => 'integer',
    ];

    public function merchant() {
        return $this->belongsToMany(Merchant::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
