<?php

namespace App\Models;

use App\Models\ExistingCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masterlist extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function existing_cases()
    {
        return $this->hasMany(ExistingCase::class);
    }

    public function type_of_case()
    {
        return $this->belongsTo(TypeOfCase::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }


}
