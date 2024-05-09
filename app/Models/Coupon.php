<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
        protected $fillable = ['code', 'status', 'redeemed_at'];
    
        public function brand()
        {
            return $this->belongsTo(Brand::class);
        }
}


