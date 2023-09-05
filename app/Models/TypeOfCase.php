<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfCase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function masterlists()
    {
        return $this->hasMany(Masterlist::class);
    }
}
