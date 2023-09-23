<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExistingCaseData extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function existing_case()
    {
        return $this->belongsTo(ExistingCase::class);
    }
}
