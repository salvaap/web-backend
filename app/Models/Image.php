<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media.images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'name', 'title',
        'absolute_path', 'relative_path', 'gallery_id',
    ];

    protected $dates = [];

    protected $casts = [
        'gallery_id' => 'integer',
    ];

    public function variants() {
        return $this->belongsToMany(Variant::class);
    }

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }
}
