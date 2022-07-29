<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function billData()
    {
        return $this->hasMany(BillData::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
