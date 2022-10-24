<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemReturn extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}