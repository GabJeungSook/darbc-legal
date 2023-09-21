<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseTemplate extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type_of_case()
    {
        return $this->belongsTo(TypeOfCase::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
