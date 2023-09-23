<?php

namespace App\Models;

use App\Models\Masterlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExistingCase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ='existing_cases';

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'documentable');
    }

    public function existing_case_datas()
    {
        return $this->hasMany(ExistingCaseData::class);
    }

    public function masterlist()
    {
        return $this->belongsTo(Masterlist::class);
    }
}
