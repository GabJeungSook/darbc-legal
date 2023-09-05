<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExistingCase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function masterlist()
    {
        return $this->belongsTo(Masterlist::class);
    }
}
