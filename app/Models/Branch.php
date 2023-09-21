<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function masterlists()
    {
        return $this->hasMany(Masterlist::class);
    }

    public function case_templates()
    {
        return $this->hasMany(CaseTemplate::class);
    }
}
