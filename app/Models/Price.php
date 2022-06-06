<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function userAmount() {
        return $this->hasMany(UserAmount::class, 'price_id', 'id')->with('user');
    }
}
