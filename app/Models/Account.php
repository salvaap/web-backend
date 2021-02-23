<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog.accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'bank_id',
        'account_titular', 'account_number', 'merchant_id',
    ];

    public function merchant() {
        return $this->belongsTo('App\Models\Merchant');
    }

    public function bank() {
        return $this->belongsTo('App\Models\Bank');
    }
}
